<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pujas extends CI_Controller {

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
		$this->load->view('welcome_message');
	}

	public function pujar($id)
	{
        date_default_timezone_set('UTC');
		$cantMin = $this->input->post('valor_min_puja');

		$id = $this->input->post('id_pet');
        $puja = $this->input->post('valor_puja');
		
		$usuario = $this->session->userdata('usuario');
        $id_user = $usuario['id'];

        $subasta = $this->productos_model->dameSubasta($id);

        if($puja < ($cantMin + 1)){
        	$this->session->set_flashdata('error_puja', 'Cantidad insertada inferior a la requerida');
        }
        else{
        	$puja_reg = array('cantidad' => $puja,
        					'fecha' => date("d-m-y"),
        					'usuario_id' => $id_user,
        					'subasta_id' => $subasta->id);

        	$this->pujas_model->insertaPuja($puja_reg);	
        }

        redirect('productos/detalle/'.$id, 'refresh');
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */