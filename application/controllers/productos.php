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
		$data['tupla'] = $this->productos_model->dameUno($id)->row();

		$data['tituloHead'] = "IWeBay Detalles del producto";
		$data['tituloBody'] = "IWeBay";
		$data['link_atras'] = anchor('productos/index', 'Volver al listado');

		$this->load->model('categoria_model');
		$data['categorias'] = $this->categoria_model->getCategorias();

		$this->load->view('productos/detalle', $data);

	}

	public function nuevo(){		

		$data['tituloHead'] = "IWeBay Crear nuevo producto";
		$data['tituloBody'] = "IWeBay";
		$data['link_atras'] = anchor('productos/index', 'Volver al listado');

		$this->load->model('categoria_model');
		$data['categorias'] = $this->categoria_model->getCategorias();

		$this->load->view('productos/nuevo', $data);

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
	 	$nombre = $this->input->post('nombreProductoSubasta');
        $estado = $this->input->post('estadoProductoSubasta');
        $cantidad = $this->input->post('cantidadProductoSubasta');
        $detalles = $this->input->post('detallesProductoSubasta');
        $precioIni = $this->input->post('precioIniProductoSubasta');
        $precioYa = $this->input->post('precioYaProductoSubasta');

        if($nombre == '' || $cantidad == '' || $detalles == '' || $precioIni == '' || $precioYa == ''){
        	$this->session->set_flashdata('error_subasta', 'Algún campo está vacio');
        	redirect('productos/nuevo','refresh');
        }
		else{
			$producto_reg = array('nombre' => $nombre,
        						'estado' => $estado,
        						'cantidad' => $cantidad,
        						'detalles' => $detalles,
        						'precio_inicial' => $precioIni,
        						'precio_compra_ya' => $precioYa);

        $this->productos_model->insertaProd($producto_reg);

        redirect ('productos', 'refresh');	
		}

        

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */