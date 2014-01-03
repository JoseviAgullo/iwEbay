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
			$this->table->set_heading('Nombre', 'Precio', 'Fecha fin', 'Vendedor');
			$this->table->set_empty('&nbsp;');

			foreach ($productos as $item) {
				$this->table->add_row($item->nombre, $item->precio_inicial, "Mañana");
			}

			$data['listado'] = $this->table->generate();
		}

        $this->load->view('productos/index.php', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */