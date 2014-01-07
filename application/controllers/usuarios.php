<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_model', '', TRUE);
        $this->load->model('votos_model', '', TRUE);
        $this->load->helper(array('form', 'url'));
    }

	public function login()
	{
        if($usuario = $this->session->userdata('usuario')) {
            $this->session->set_flashdata('error', '¡Ya estás logueado!');
            redirect('usuarios/perfil/' . $usuario['id'],'refresh');
        } else {
            $data['tituloHead'] = "IWeBay - Login";
            $data['tituloBody'] = "IWeBay";
            $this->load->view('usuarios/login', $data);
        }
	}
    public function perfil($id)
    {
        $tupla = $this->usuarios_model->getUsuario($id);
        $data['tupla'] = $tupla;
        $data['tienda'] = $this->usuarios_model->getTiendaId(array('id' => $tupla->id));
        $data['tituloHead'] = "IWeBay Perfil de ".$tupla->userName;
        $data['tituloBody'] = "IWeBay";
        $data['action'] = 'usuarios/votar';
        $data['cantidad_positivos'] = $this->votos_model->votos_positivos($id); 
        $data['cantidad_total'] = $this->votos_model->cuenta_todos($id); 


        $data['tituloHead'] = "IWeBay - ".$tupla->userName;
        $data['tituloBody'] = "IWeBay";
        $this->load->view('usuarios/perfil', $data);
    }

    public function registro()
    {
        if($usuario = $this->session->userdata('usuario')){
            redirect('usuarios/perfil/' . $usuario['id'], 'refresh');
        } else {
            $data['tituloHead'] = "IWeBay - Regístrate";
            $data['tituloBody'] = "IWeBay";
            $this->load->view('usuarios/registro', $data);
        }
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
            $aux = $this->usuarios_model->getPorNick($usuario['nick']);
            $usuario['id'] = $aux->id;
            $usuario['email'] = $aux->email;
            $this->session->set_userdata('usuario',$usuario);
            redirect ('inicio', 'refresh');
        } else {
            $this->session->set_flashdata('error_login', 'Usuario o contraseña incorrectas');
            redirect ('usuarios/login', 'refresh');
        }
    }

    public function do_logout()
    {
        $this->session->unset_userdata('usuario');
        redirect ('inicio/index', 'refresh');
    }

    public function registrar()
    {
        $nick = $this->input->post('username');
        $pass = $this->input->post('pass1');
        $pass2 = $this->input->post('pass2');
        $email = $this->input->post('email');
        $fecha_nac = $this->input->post('f_nacimiento');
        $direccion = $this->input->post('direccion');
        $tos = $this->input->post('tos');
        $informado = $this->input->post('informado');
        $tlf = $this->input->post('telefono');

        if($nick == '' || $pass == '' || $pass2 == '' || $email == '')
        {
            $this->session->set_flashdata('error', 'Campos obligatorios vacios');
            redirect('usuarios/registro','refresh');
        }

        if($pass != $pass2)
        {
            $this->session->set_flashdata('error', 'Las contraseñas no coinciden');
            redirect('usuarios/registro','refresh');
        }

        if($tos)
        {
            date_default_timezone_set('UTC');
            $fecha = date_parse($fecha_nac);
            $user_registrar = array('userName' => $nick,
                         'password' => $pass,
                        'email'=>$email,
                        'direccion'=>$direccion,
                        'telefono'=>$tlf,
                        'fecha_nacimiento'=> $fecha['year'] . '-' . $fecha['month'] . '-' . $fecha['day']);
            $user_id = $this->usuarios_model->registrar($user_registrar);
            if($user_id > 0) {
                $usuario = array();
                $usuario['id'] = $user_id;
                $usuario['nick'] = $nick;
                $usuario['email'] = $email;
                $usuario['password'] = $pass;
                $this->session->set_userdata('usuario',$usuario);
                redirect('usuarios/perfil/'.$nick, 'refresh');
            } else {
                $this->session->set_flashdata('error', '¡UPS! Ha habido un problema al registrarte, espera unos segundos e intentalo de nuevo');
                redirect('usuarios/registro','refresh');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'Debe aceptar los términos y condiciones');
            redirect('usuarios/registro','refresh');
        }
    }

    public function productos($id,$categoria) {
        $categoria = urldecode($categoria);
        $data['tituloHead'] = "IWeBay - " . $categoria;
        $data['tituloBody'] = "IWeBay";
        $this->load->model('productos_model', '', TRUE);
        $productos = $this->productos_model->getProductosUsuario($id,$categoria);
        $categorias = $this->usuarios_model->getCategoriaDeProductos($id);

        $this->load->library('table');
        $this->table->set_heading('Nombre', 'Precio', 'Fecha fin', 'Detalles');
        $this->table->set_empty('&nbsp;');

        foreach ($productos as $item) {
            $this->table->add_row($item->nombre, $item->precio_inicial . '€', "Mañana", anchor('productos/detalle/'.$item->id , 'Detalles'));
        }
        $data['listado'] = $this->table->generate();

        $data['usuario'] = $this->usuarios_model->getUsuario($id);
        $data['tienda'] = $this->usuarios_model->getTienda(array('id' => $id));
        $data['categorias'] = $categorias;
        $this->load->view('usuarios/productos',$data);
    }

    public function subir_imagen($id)
    {
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $filename = $this->input->post('userfile');

        $this->load->library('upload', $config);
        $this->load->helper('html');

        if ( ! $this->upload->do_upload())
        {
           echo ('Error');
        }
        else
        {
           $this->upload->display_errors('<p>', '</p>');
          echo img('images/'.  $this->upload->data()['file_name']);
        }
    }
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */