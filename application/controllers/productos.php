<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('productos_model', '', TRUE);
		$this->load->model('usuarios_model', '', TRUE);
		$this->load->model('subastas_model', '', TRUE);
		$this->load->model('pujas_model', '', TRUE);
		$this->load->library('session');
	}

	public function index()
	{
		$data['tituloHead'] = "IWeBay Productos";
        $data['tituloBody'] = "IWeBay";
        date_default_timezone_set('UTC');

        $productos = $this->productos_model->listado();		
		$data['cuantos'] = $this->productos_model->cuenta_todos();

		$this->load->library('table');

		$data['listado'] = "No se han encontrado productos";		

		if($data['cuantos'] > 0){
			$this->table->set_heading('Nombre', 'Precio', 'Fecha fin', 'Detalles');
			$this->table->set_empty('&nbsp;');

			foreach ($productos as $item) {
				$this->table->add_row($item->nombre, $item->precio_inicial, date("d-m-Y", strtotime($item->fecha_fin)), anchor('productos/detalle/'.$item->id , 'Detalles'));
			}

			$data['listado'] = $this->table->generate();
		}

		$this->load->model('categoria_model');
		$data['categorias'] = $this->categoria_model->getCategorias();

        $this->load->view('productos/index.php', $data);
	}

	public function detalle($id){
		//recogemos el producto con su subasta y su creador
		$data['tupla'] = $this->productos_model->dameUno($id);

		//recogemos la puja máxima correspondiente al producto
		$data['puja'] = $this->productos_model->damePujaProd($id);

		$data['tienda'] = $this->productos_model->dameTienda($data['tupla']->id);	

		$data['img_perfil'] = img('images/producto/'.$id.'_thumb.jpg' );	


		$data['tituloHead'] = "IWeBay Detalles del producto";
		$data['tituloBody'] = "IWeBay";
		$data['link_atras'] = anchor('productos/index', 'Volver al listado');

		$this->load->model('categoria_model');
		$data['categorias'] = $this->categoria_model->getCategorias();

		$this->load->view('productos/detalle', $data);
	}

	public function nuevo(){
		if($usuario = $this->session->userdata('usuario')){
            $data['tituloHead'] = "IWeBay Crear nuevo producto";
			$data['tituloBody'] = "IWeBay";
			$data['link_atras'] = anchor('productos/index', 'Volver al listado');

			$this->load->model('categoria_model');
			$data['categorias'] = $this->categoria_model->getCategorias();

			$this->load->view('productos/nuevo', $data);
        } 
        else {
            show_error('Debes estar logueado para acceder a esta pagina', 403);
        }
	}

	public function categoria($categoria){
        $categoria = urldecode($categoria);
		$data['tituloHead'] = "IWeBay - ".$categoria;
		$data['tituloBody'] = "IWeBay";

		date_default_timezone_set('UTC');

		$productos = $this->productos_model->listado_categoria($categoria);		
		$data['cuantos'] = $this->productos_model->cuenta_categoria($categoria);

		$this->load->library('table');

		$data['listado'] = "No se han encontrado productos";		

		if(count($productos) > 0){
			$this->table->set_heading('Nombre', 'Precio', 'Fecha fin', 'Detalles');
			$this->table->set_empty('&nbsp;');

			foreach ($productos as $item) {
				$this->table->add_row($item->nombre, $item->precio_inicial, date("d-m-Y", strtotime($item->fecha_fin)), anchor('productos/detalle/'.$item->id , 'Detalles'));
			}

			$data['listado'] = $this->table->generate();
		}

		$this->load->model('categoria_model');
		$data['categorias'] = $this->categoria_model->getCategorias();

        $this->load->view('productos/index.php', $data);
	}

	 public function nuevoProd(){
	 	//elementos producto
	 	$nombre = $this->input->post('nombreProductoSubasta');
        $estado = $this->input->post('estadoProductoSubasta');
        $cantidad = $this->input->post('cantidadProductoSubasta');
        $detalles = $this->input->post('detallesProductoSubasta');
        $precioIni = $this->input->post('precioIniProductoSubasta');
        $precioYa = $this->input->post('precioYaProductoSubasta');

        //elementos subasta
		$descSubasta = $this->input->post('descripcion_subasta');
		$fechaFinSubasta = $this->input->post('fechaFinSubasta');
		$compraYaSubasta = $this->input->post('checkCompraYa');
		$tipoEnvio = $this->input->post('tipoEnvioProductoSubasta');
		$gastosEnvio = $this->input->post('gastosEnvioProductoSubasta');
		$formaPago = $this->input->post('formaPagoProductoSubasta');

		//categoria seleccionada
		$categoria = $this->input->post('categoriaProductoSubasta');

        if($nombre == '' || $cantidad == '' || $detalles == '' || $precioIni == '' ||  $descSubasta == '' || $fechaFinSubasta == '' || $gastosEnvio == ''){
        	$this->session->set_flashdata('error_subasta', 'Algún campo está vacio');
        	redirect('productos/nuevo','refresh');
        }
        else
        {
            if($compraYaSubasta)
            {
                $ya = 1;
                if($precioYa == '') {
                    $this->session->set_flashdata('error_subasta', 'Tienes que especificar el precio de compra directa');
                    redirect('productos/nuevo','refresh');
                }
                if ($precioIni >= $precioYa)
                {
                    $this->session->set_flashdata('error_subasta', 'El precio de subasta debe ser inferior al de compra directa');
                    redirect('productos/nuevo','refresh');
                }
            } else {
                $ya = 0;
                $precioYa = 0;
            }

            //registramos el producto
            $producto_reg = array('nombre' => $nombre,
                'estado' => $estado,
                'cantidad' => $cantidad,
                'detalles' => $detalles,
                'precio_inicial' => $precioIni,
                'precio_compra_ya' => $precioYa);

            $id_producto = $this->productos_model->insertaProd($producto_reg);

            //añadimos la categoria del producto a la tabla correspondiente

            $prodCat = array('producto_id' => $id_producto,
                'categoria_id' => $categoria);

            $this->productos_model->guardarCategProd($prodCat);

            //obtenemos el id del user mirando en sesión el nombre registrado
            $usuario = $this->session->userdata('usuario');
            $id_user = $usuario['id'];

            date_default_timezone_set('UTC');
            $fecha = date_parse($fechaFinSubasta);
            $subasta_reg = array('descripcion' => $descSubasta,
                'fecha_fin' => $fecha['year'] . '-' . $fecha['month'] . '-' . $fecha['day'],
                'compra_ya' => $ya,
                'tipo_envio' => $tipoEnvio,
                'forma_pago' => $formaPago,
                'gastos_envio' => $gastosEnvio,
                'usuario_id' => $id_user,
                'producto_id' => $id_producto);

            $this->subastas_model->insertaSubasta($subasta_reg);

            $config['upload_path'] = './images/producto';
	            $config['allowed_types'] = 'jpg';
	            $config['overwrite'] = 'true';

	            $config['file_name'] = $id_producto;
	            $filename = $this->input->post('userfile');

	            $this->load->library('upload', $config);
	            $this->load->helper('html');

	            if ($this->upload->do_upload())
	            {
	                $config2['image_library'] = 'gd2';
	                $config2['source_image'] = $this->upload->data()['full_path'];;
	                $config2['create_thumb'] = TRUE;
	                $config2['maintain_ratio'] = TRUE;
	                $config2['width']     = 150;
	                $config2['height']   = 150;
	                $this->load->library('image_lib', $config2);

	                $this->image_lib->resize();

	            }

            redirect ('productos', 'refresh');
		}
	}

    public function do_modificar($id)
    {
        //elementos producto
        $nombre = $this->input->post('nombreProductoSubasta');
        $estado = $this->input->post('estadoProductoSubasta');
        $cantidad = $this->input->post('cantidadProductoSubasta');
        $detalles = $this->input->post('detallesProductoSubasta');
        $precioIni = $this->input->post('precioIniProductoSubasta');
        $precioYa = $this->input->post('precioYaProductoSubasta');

        //elementos subasta
        $descSubasta = $this->input->post('descripcion_subasta');
        $fechaFinSubasta = $this->input->post('fechaFinSubasta');
        $compraYaSubasta = $this->input->post('checkCompraYa');
        $tipoEnvio = $this->input->post('tipoEnvioProductoSubasta');
        $gastosEnvio = $this->input->post('gastosEnvioProductoSubasta');
        $formaPago = $this->input->post('formaPagoProductoSubasta');

        //categoria seleccionada
        $categoria = $this->input->post('categoriaProductoSubasta');

        if($nombre == '' || $cantidad == '' || $detalles == '' || $precioIni == '' ||  $descSubasta == '' || $fechaFinSubasta == '' || $gastosEnvio == ''){
            $this->session->set_flashdata('error_subasta', 'Algún campo está vacio');
            redirect('productos/nuevo','refresh');
        }
        else
        {
            if($compraYaSubasta)
            {
                $ya = 1;
                if($precioYa == '') {
                    $this->session->set_flashdata('error_subasta', 'Tienes que especificar el precio de compra directa');
                    redirect('productos/nuevo','refresh');
                }
                if ($precioIni >= $precioYa)
                {
                    $this->session->set_flashdata('error_subasta', 'El precio de subasta debe ser inferior al de compra directa');
                    redirect('productos/nuevo','refresh');
                }
            } else {
                $ya = 0;
                $precioYa = 0;
            }

            //registramos el producto
            $producto_reg = array(
                'id' => $id,
                'nombre' => $nombre,
                'estado' => $estado,
                'cantidad' => $cantidad,
                'detalles' => $detalles,
                'precio_inicial' => $precioIni,
                'precio_compra_ya' => $precioYa);

            $this->productos_model->modificar($producto_reg);

            //añadimos la categoria del producto a la tabla correspondiente

            $prodCat = array('producto_id' => $id,
                'categoria_id' => $categoria);

            $this->productos_model->modificarCategProd($id,$prodCat);

            //obtenemos el id del user mirando en sesión el nombre registrado
            $usuario = $this->session->userdata('usuario');
            $id_user = $usuario['id'];

            date_default_timezone_set('UTC');
            $fecha = date_parse($fechaFinSubasta);
            $subasta_reg = array(
                'id' => $this->productos_model->dameSubasta($id)->id,
                'descripcion' => $descSubasta,
                'fecha_fin' => $fecha['year'] . '-' . $fecha['month'] . '-' . $fecha['day'],
                'compra_ya' => $ya,
                'tipo_envio' => $tipoEnvio,
                'forma_pago' => $formaPago,
                'gastos_envio' => $gastosEnvio,
                'usuario_id' => $id_user,
                'producto_id' => $id);

            $this->subastas_model->modificar($subasta_reg);

            $config['upload_path'] = './images/producto';
            $config['allowed_types'] = 'jpg';
            $config['overwrite'] = 'true';

            $config['file_name'] = $id;
            $filename = $this->input->post('userfile');

            $this->load->library('upload', $config);
            $this->load->helper('html');

            if ($this->upload->do_upload())
            {
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $this->upload->data()['full_path'];;
                $config2['create_thumb'] = TRUE;
                $config2['maintain_ratio'] = TRUE;
                $config2['width']     = 150;
                $config2['height']   = 150;
                $this->load->library('image_lib', $config2);

                $this->image_lib->resize();

            }

            redirect ('productos', 'refresh');
        }
    }

    public function modificar($producto_id){
        if($usuario = $this->session->userdata('usuario')){
            $data['tituloHead'] = "IWeBay Crear nuevo producto";
            $data['tituloBody'] = "IWeBay";
            $data['link_atras'] = anchor('productos/index', 'Volver al listado');

            $this->load->model('categoria_model');
            $data['categorias'] = $this->categoria_model->getCategorias();
            $data['producto'] = $this->productos_model->dameUno($producto_id);
            $data['subasta'] = $this->productos_model->dameSubasta($producto_id);

            $this->load->view('productos/modificar', $data);
        }
        else {
            show_error('Debes estar logueado para acceder a esta pagina', 403);
        }
    }

    public function borrar($producto_id)
    {
        if($usuario = $this->session->userdata('usuario')) {
            $producto = $this->productos_model->dameUno($producto_id);
            if($usuario['id'] == $producto->usuario_id){
                $this->productos_model->borrar($producto_id);
                redirect('productos/index','refresh');
            } else {
                show_error('No tienes permiso para realizar esta accion', 403, 'Prohibido');
            }
        } else {
            show_error('Debes estar logueado para realizar esta accion', 403, 'Prohibido');
        }
    }
}
