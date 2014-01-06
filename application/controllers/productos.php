<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

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

        $productos = $this->productos_model->listado();		
		$data['cuantos'] = $this->productos_model->cuenta_todos();

		$this->load->library('table');

		$data['listado'] = "No se han encontrado productos";		

		if($data['cuantos'] > 0){
			$this->table->set_heading('Nombre', 'Precio', 'Fecha fin', 'Detalles');
			$this->table->set_empty('&nbsp;');

			foreach ($productos as $item) {
				$this->table->add_row($item->nombre, $item->precio_inicial, "Mañana", anchor('productos/detalle/'.$item->id , 'Detalles'));
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
		$data['tituloHead'] = "IWeBay ".$categoria;
		$data['tituloBody'] = "IWeBay";

		$productos = $this->productos_model->listado_categoria($categoria);		
		$data['cuantos'] = $this->productos_model->cuenta_categoria($categoria);

		$this->load->library('table');

		$data['listado'] = "No se han encontrado productos";		

		if($data['cuantos'] > 0){
			$this->table->set_heading('Nombre', 'Precio', 'Fecha fin', 'Detalles');
			$this->table->set_empty('&nbsp;');

			foreach ($productos as $item) {
				$this->table->add_row($item->nombre, $item->precio_inicial, "Mañana", anchor('productos/detalle/'.$item->id , 'Detalles'));
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

        if($nombre == '' || $cantidad == '' || $detalles == '' || $precioIni == '' || $precioYa == '' || $descSubasta == '' || $fechaFinSubasta == '' || $gastosEnvio == ''){
        	$this->session->set_flashdata('error_subasta', 'Algún campo está vacio');
        	redirect('productos/nuevo','refresh');
        }
		else{
			if ($precioIni >= $precioYa)
			{
				$this->session->set_flashdata('error_subasta', 'El precio de subasta debe ser inferior al de compra directa');
        		redirect('productos/nuevo','refresh');		
	        }
			else{
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

	        	$subasta_reg = array('descripcion' => $descSubasta,
	        							'fecha_fin' => $fechaFinSubasta,
	        							'compra_ya' => $compraYaSubasta,
	        							'tipo_envio' => $tipoEnvio,
	        							'forma_pago' => $formaPago,
	        							'gastos_envio' => $gastosEnvio,
	        							'usuario_id' => $id_user,
	        							'producto_id' => $id_producto);

	        	$this->subastas_model->insertaSubasta($subasta_reg);

	        	redirect ('productos', 'refresh');	
        	}
		}
	}
    

}
