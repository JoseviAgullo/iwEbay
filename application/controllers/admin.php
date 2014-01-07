<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->database();
		$this->load->library('session');
    }

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
	public function productos()
	{
		if($usuario = $this->session->userdata('usuario') && $this->session->userdata('usuario')['nick']=='admin')
		{
			$crud = new Grocery_CRUD();
			$crud->set_table('producto');
			$output = $crud->render();
			$this->load->view('admin/productos',$output);
		}
		else
		{
			 show_error('Debes estar logueado como administrador para acceder a esta pagina', 403);
		}
	}

	public function index()
	{
		if($usuario = $this->session->userdata('usuario') && $this->session->userdata('usuario')['nick']=='admin')
		{
			$data['tituloHead'] = "IWeBay - Administración";
	        $data['tituloBody'] = "IWeBay - Administración";
			$this->load->view('admin/index',$data);
		}
		else
		{
			 show_error('Debes estar logueado como administrador para acceder a esta pagina', 403);
		}
	}

	public function subastas()
	{
		if($usuario = $this->session->userdata('usuario') && $this->session->userdata('usuario')['nick']=='admin')
		{
			$crud = new Grocery_CRUD();
			$crud->set_table('subasta');
			$output = $crud->render();
			$this->load->view('admin/subastas',$output);
		}
		else
		{
			 show_error('Debes estar logueado como administrador para acceder a esta pagina', 403);
		}
	}

	public function tiendas()
	{
		if($usuario = $this->session->userdata('usuario') && $this->session->userdata('usuario')['nick']=='admin')
		{
			$crud = new Grocery_CRUD();
			$crud->set_table('tienda');
			$output = $crud->render();
			$this->load->view('admin/tiendas',$output);
		}
		else
		{
			 show_error('Debes estar logueado como administrador para acceder a esta pagina', 403);
		}
	}

	public function usuarios()
	{
		if($usuario = $this->session->userdata('usuario') && $this->session->userdata('usuario')['nick']=='admin')
		{	
			$crud = new Grocery_CRUD();
			$crud->set_table('usuario');
			$output = $crud->render();
			$this->load->view('admin/usuarios',$output);
		}
		else
		{
			 show_error('Debes estar logueado como administrador para acceder a esta pagina', 403);
		}
	}

	public function votos()
	{
		if($usuario = $this->session->userdata('usuario') && $this->session->userdata('usuario')['nick']=='admin')
		{
			$crud = new Grocery_CRUD();
			$crud->set_table('voto');
			$output = $crud->render();
			$this->load->view('admin/votos',$output);
		}
		else
		{
			 show_error('Debes estar logueado como administrador para acceder a esta pagina', 403);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */