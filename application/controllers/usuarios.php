<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_model', '', TRUE);
        $this->load->library('session');
    }

	public function login()
	{
        $data['tituloHead'] = "IWeBay";
        $data['tituloBody'] = "IWeBay";
        $this->load->view('usuarios/login', $data);
	}
    public function perfil()
    {
        $data['tituloHead'] = "IWeBay";
        $data['tituloBody'] = "IWeBay";
        $this->load->view('usuarios/perfil', $data);
    }

    public function registro()
    {
        $data['tituloHead'] = "IWeBay";
        $data['tituloBody'] = "IWeBay";
        $this->load->view('usuarios/registro', $data);
    }

    public function do_login()
    {
        $nick = $this->input->post('nick');
        $password = $this->input->post('password');

        if($nick == '' || $password == '') {
            $_FLASH['error_login'] = 'Usuario o contraseña vacios';
            redirect('usuarios/login','refresh');
        }

        $usuario = array('nick' => $nick,
                         'password' => $password);
        if ($this->usuarios_model->login($usuario)) {
            $this->session->set_userdata($usuario);
            redirect ('inicio', 'refresh');
        } else {
            $_FLASH['error_login'] = 'Usuario o contraseña erronea';
            redirect ('usuarios/login', 'refresh');
        }
    }

    public function registrar()
    {
        echo 'Registro realizado PATATALMENTE' . ' controllers/usuarios.php';
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */