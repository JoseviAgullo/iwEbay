<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiendas extends CI_Controller {

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

        $this->load->model('tiendas_model', '', TRUE);
        $this->load->model('usuarios_model', '', TRUE);
		$this->load->model('categoria_model', '', TRUE);

	}
	public function tienda($tienda_id)
	{

		$data['tituloBody'] = "IWeBay";

        $tienda = $this->tiendas_model->getTienda($tienda_id);
        if($tienda == '') {
            show_404();
        } else {
            $data['tienda'] = $tienda;
            $data['tituloHead'] = "IWeBay - " . $tienda->nombre;
        }

        $usuario = $this->tiendas_model->getUsuario($tienda_id);
        if($usuario == '') {
            show_error('No se ha podido encontrar informacion del usuario de la tienda ' . $tienda_id);
        } else {
            $data['usuario'] = $usuario;
        }
        
        $data['propietario'] = '';        
        if($this->session->userdata('usuario')){
            $user = $this->session->userdata('usuario');
            $id_user = $user['id'];    
            if($id_user == $usuario->id){
                $data['propietario'] = 'si';
            }
        }
        

		$categorias = $this->usuarios_model->getCategoriaDeProductos($usuario->id);
        if(count($categorias) <= 0) {
            $data['categorias'] = array();
        } else {
            $data['categorias'] = $categorias;
        }

        $data['ultimas'] = $this->usuarios_model->getUltimasSubastas($usuario->id);

		$this->load->view('tiendas/tienda.php', $data);

	}

    public function nueva(){

        if($usuario = $this->session->userdata('usuario'))
        {
            if($this->usuarios_model->tieneTienda($usuario)){
                $tienda_id = $this->usuarios_model->getTiendaId($usuario);
                redirect('tiendas/tienda/'.$tienda_id, 'refresh');
            }
            $data['tituloHead'] = "IWeBay";
            $data['tituloBody'] = "IWeBay";

            $this->load->view('tiendas/nueva', $data);
        } else {
            show_error('Debes estar logueado para acceder a esta pagina', 403);
        }
    }

    public function crear() {
        if($usuario = $this->session->userdata('usuario')) {
            $tienda = array();
            $tienda['nombre'] = $this->input->post('nombre');
            $tienda['descripcion'] = $this->input->post('descripcion');

            if($tienda['nombre'] == '' || $tienda['descripcion'] == '') {
                $this->session->set_flashdata('error', 'Campo/s obligatorio/s vacio/s');
                redirect('tiendas/nueva','refresh');
            } else {
                $tienda_id = $this->tiendas_model->crear($tienda,$usuario);
                if($tienda_id){
                    $this->session->set_flashdata('exito', '¡Tienda creada con exito!');
                    redirect('tiendas/tienda/' . $tienda_id);
                } else {
                    $this->session->set_flashdata('error', '¡UPS! Parece que algo ha ido mal, por favor espera unos segundos y vuelve a intentarlo');
                    redirect('tiendas/nueva','refresh');
                }
            }
        } else {
            show_error('Debes estar logueado para acceder a esta pagina', 403);
        }
    }

    public function modificar($tienda_id)
    {
        if($usuario = $this->session->userdata('usuario')) {
            $user_id = $this->tiendas_model->getUsuarioId($tienda_id);
            if($usuario['id'] == $user_id){
                $data['tienda'] = $this->tiendas_model->getTienda($tienda_id);
                $data['tituloHead'] = "IWeBay - " . $data['tienda']->nombre;
                $data['tituloBody'] = "IWeBay";
                $this->load->view('tiendas/modificar', $data);
            } else {
                show_error('Debe ser el propietario de esta tienda para realizar esta accion', 403, 'Prohibido');
            }
        } else {
            show_error('Debe estar logueado para acceder a esta pagina',403,'Acceso Prohibido');
        }
    }

    public function do_modificar($tienda_id)
    {
        if($usuario = $this->session->userdata('usuario')) {
            $user_id = $this->tiendas_model->getUsuarioId($tienda_id);
            if($usuario['id'] == $user_id){
                $tienda = array(
                    'id' => $tienda_id,
                    'nombre' => $this->input->post('nombre'),
                    'descripcion' => $this->input->post('descripcion')
                );
                $this->tiendas_model->modificarTienda($tienda);
                redirect('tiendas/tienda/' . $tienda_id, 'refresh');
            } else {
                show_error('Debe ser el propietario de esta tienda para realizar esta accion', 403, 'Prohibido');
            }
        } else {
            show_error('Debe estar logueado para acceder a esta pagina',403,'Acceso Prohibido');
        }
    }

    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */