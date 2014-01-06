<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Votos extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('votos_model', '', TRUE);
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
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function votar($usuario_destino)
    {
    	if($usuario = $this->session->userdata('usuario'))
        {
	    	$usuario_origen = $this->session->userdata('usuario');
	        echo ('hola, '. $usuario_origen['id']);
	        $formSubmit = $this->input->post('env_voto');
	        $desc = $this->input->post('desc');

	        //Recuperamos el nombre del destino con flashdata, para luego redireccionar a él.
	        $nombreDestino = $this->session->flashdata('nombreDestino');


	        if( $formSubmit == 'posi' )
	        	$this->votos_model->votar_positivo($usuario_origen['id'], $usuario_destino, $desc);
	        else
	        	$this->votos_model->votar_negativo($usuario_origen['id'], $usuario_destino, $desc);

	        $this->session->set_flashdata('votoOK', 'Voto realizado correctamente');

	        redirect('usuarios/perfil/'.$nombreDestino,'refresh');
	    }
	    else {
            show_error('Debes estar logueado para acceder a esta pagina', 403);
        }		    	
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */