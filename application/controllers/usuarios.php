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
            $this->session->set_flashdata('error_login', 'Usuario o contraseña vacios');
            redirect('usuarios/login','refresh');
        }

        $usuario = array('nick' => $nick,
                         'password' => $password);
        if ($this->usuarios_model->login($usuario)) {
            $this->session->set_userdata($usuario);
            redirect ('inicio', 'refresh');
        } else {
            $this->session->set_flashdata('error_login', 'Usuario o contraseña incorrectas');
            redirect ('usuarios/login', 'refresh');
        }
    }

    public function registrar()
    {
        $nick = $this->input->post('nick');
        $pass = $this->input->post('pass');
        $pass2 = $this->input->post('pass2');
        $email = $this->input->post('email');
        $email2 = $this->input->post('email2');
        $nombre = $this->input->post('nombre');
        $apellidos = $this->input->post('apellidos');
        $fecha_nac = $this->input->post('fecha');
        $genero = $this->input->post('genero');
        $nacionalidad = $this->input->post('nacionalidad');
        $direccion = $this->input->post('direccion');
        $provincia = $this->input->post('provincia');
        $localidad = $this->input->post('localidad');
        $tos = $this->input->post('tos');
        $informado = $this->input->post('informado');

        //Verificamos que no hayan campos vacios
        if($nick == '' || $pass == '' || $pass2 == '' || $email == '' || $email2 == '')
        {
            $this->session->set_flashdata('error_registro_vacio', 'Campos obligatorios vacios');
            redirect('usuarios/registro','refresh');
        }

        //Verificamos que las contraseñas coincidan
        if($pass != $pass2)
        {
            $this->session->set_flashdata('error_registro_pass', 'Las contraseñas no coinciden');
            redirect('usuarios/registro','refresh');
        }

        if($email != $email2)
        {
            $this->session->set_flashdata('error_registro_email', 'El email no coincide');
            redirect('usuarios/registro','refresh');
        }

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */