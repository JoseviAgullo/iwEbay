<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

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
	public function login()
	{
        $data['tituloHead'] = "IWeBay";
        $data['tituloBody'] = "IWeBay";
        $this->load->view('usuarios/login', $data);
	}

    public function registro()
    {
        $data['tituloHead'] = "IWeBay";
        $data['tituloBody'] = "IWeBay";
        $this->load->view('usuarios/registro', $data);
    }

    public function do_login()
    {
        echo 'Aquí llegamos, estamos en el controlador de usuarios: controllers/usuarios.php';
    }

    public function registrar()
    {
        echo 'Registro realizado PATATALMENTE' . ' controllers/usuarios.php';
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */