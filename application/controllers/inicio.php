<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

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

		$this->load->model('categoria_model', '', TRUE);
		$this->load->model('productos_model', '', TRUE);

	}

	public function index()
	{
		$data['tituloHead'] = "IWeBay";
		$data['tituloBody'] = "IWeBay";

		$data['categorias'] = $this->categoria_model->getCategorias();

		//Para productos destacados
		$productos_destacados = $this->productos_model->listado_destacados();		
		$data['cuantos'] = $this->productos_model->cuenta_destacados();

		$this->load->library('table');

		$data['listado_destacados'] = "No se han encontrado productos destacados";		

		if($data['cuantos'] > 0){

			$data['listado_destacados'] = $productos_destacados;
		}

		$this->load->view('inicio/index.php', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */