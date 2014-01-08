<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_model', '', TRUE);
        $this->load->model('productos_model', '', TRUE);
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
        date_default_timezone_set('UTC');
        $tupla = $this->usuarios_model->getUsuario($id);
		
		if($tupla)
		{
			$data['tupla'] = $tupla;
			$data['tienda'] = $this->usuarios_model->getTiendaId(array('id' => $tupla->id));
			$data['tituloHead'] = "IWeBay Perfil de ".$tupla->userName;
			$data['tituloBody'] = "IWeBay";
			$data['action'] = 'usuarios/votar';
			$data['cantidad_positivos'] = $this->votos_model->votos_positivos($id); 
			$data['cantidad_total'] = $this->votos_model->cuenta_todos($id); 
			$data['img_perfil'] = img('images/user/'.$id.'_thumb.jpg' );

			$ventas_bruto = $this->productos_model->productos_usuario($id);
			if($ventas_bruto)
			{
			$this->load->library('table');

			$this->table->set_heading('Descripcion', 'Gastos de Envío', 'Fecha Fin','Última Puja','Compralo Ya', 'Detalles');
				$this->table->set_empty('&nbsp;');

				foreach ($ventas_bruto as $item) {

					$precio_bet = $this->productos_model->damePujaProd($item->producto_id);
					if($precio_bet)
						$this->table->add_row($item->descripcion, $item->gastos_envio, date("d-m-Y", strtotime($item->fecha_fin)), $precio_bet->cantidad, $item->precio_compra_ya, anchor('productos/detalle/'.$item->producto_id , 'Detalles'));
					else
						$this->table->add_row($item->descripcion, $item->gastos_envio, date("d-m-Y", strtotime($item->fecha_fin)), $item->precio_inicial, $item->precio_compra_ya, anchor('productos/detalle/'.$item->producto_id , 'Detalles'));

				}

				$data['ventas'] = $this->table->generate();
			}
			else
			{
				$data['ventas'] = "El usuario actualmente no tiene ninguna subasta activa";
			}

			$data['tituloHead'] = "IWeBay - ".$tupla->userName;
			$data['tituloBody'] = "IWeBay";
			$this->load->view('usuarios/perfil', $data);
			}
			else
			{
				show_error('No existe este usuario', 404, 'No encontrado');
			}
			
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
                redirect('usuarios/perfil/'.$user_id, 'refresh');
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

    public function modificar($user_id)
    {
        $usuario = $this->session->userdata('usuario');
        if($usuario && $usuario['id'] == $user_id){
            $data['tituloHead'] = 'IWeBay - ' . $usuario['nick'];
            $data['tituloBody'] = 'IWeBay';
            $data['usuario'] = $this->usuarios_model->getTodo($user_id);
            $this->load->view('usuarios/modificar',$data);
        } else {
            show_error('Debes estar logueado para ver esta pagina', 403, 'Acceso no permitido');
        }
    }

    public function do_modificar($user_id)
    {
        $usuario = $this->session->userdata('usuario');
        if($usuario && $usuario['id'] == $user_id ){

            /*
            *   Parte en la cual subimos un fichero. Hemos puesto que solo permita .JPG
            */
            $config['upload_path'] = './images/user';
            $config['allowed_types'] = 'jpg';
            $config['overwrite'] = 'true';
            
            $config['file_name'] = $user_id;
            $filename = $this->input->post('userfile');

            $this->load->library('upload', $config);
            $this->load->helper('html');

            if ($this->upload->do_upload())
            {    
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $this->upload->data()['full_path'];;
                $config2['create_thumb'] = TRUE;
                $config2['maintain_ratio'] = TRUE;
                $config2['width']     = 150;
                $config2['height']   = 150;
                $this->load->library('image_lib', $config2); 

                $this->image_lib->resize();
            }

            $nick = $this->input->post('username');
            $pass1 = $this->input->post('pass1');
            $pass2 = $this->input->post('pass2');
            $email = $this->input->post('email');
            $fecha_nac = $this->input->post('f_nacimiento');
            $direccion = $this->input->post('direccion');
            $tlf = $this->input->post('telefono');
            $pass = $this->input->post('password');

            if($pass != $usuario['password']) {
                $this->session->set_flashdata('error', 'Contraseña incorrecta');
                redirect('usuarios/modificar/' . $user_id, 'refresh');
            }

            if($nick == '' || $email == '')
            {
                $this->session->set_flashdata('error', 'Campos obligatorios vacios');
                redirect('usuarios/modificar/' . $user_id, 'refresh');
            }

            if($pass1 != '' && $pass1 != $pass2)
            {
                $this->session->set_flashdata('error', 'Las contraseñas no coinciden');
                redirect('usuarios/modificar/' . $user_id, 'refresh');
            } elseif($pass1 == '') {
                $pass1 = $pass;
            }

            date_default_timezone_set('UTC');
            $fecha = date_parse($fecha_nac);
            $user = array(
                'id' => $user_id,
                'userName' => $nick,
                'password' => $pass1,
                'email'=>$email,
                'direccion'=>$direccion,
                'telefono'=>$tlf,
                'fecha_nacimiento'=> $fecha['year'] . '-' . $fecha['month'] . '-' . $fecha['day']);
            $this->usuarios_model->modificar($user);
            redirect('usuarios/perfil/' . $user_id, 'refresh');
        } else {
            show_error('Debes estar logueado para ver esta pagina', 403, 'Acceso no permitido');
        }
    }

    public function borrar($id)
    {
        if($usuario = $this->session->userdata('usuario') && $this->session->userdata('usuario')['id'] == $id)
        {
            $this->usuarios_model->borrar($id);
            $this->do_logout();
        } else {
            show_error('Debes estar logueado para realizar esta accion', 403, 'Acceso no permitido');
        }
    }
}
