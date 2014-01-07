<?php 
	class usuarios_model extends CI_Model {
        private $tabla = 'usuario';

        public function login($usuario)
        {
            $this->db->select('password');
            $this->db->from($this->tabla);
            $this->db->where('userName', $usuario['nick']);
            $resultado = $this->db->get()->result();

            if (count($resultado) > 0){
                $password = $resultado[0]->password;
                return $password == $usuario['password'];
            }

            return false;
        }

        public function registrar($usuario)
        {
            
            $this->db->insert($this->tabla, $usuario);

            $id = $this->db->insert_id();

            return $id;
        }

        public function getUsuario($id)
        {
            $this->db->select('id, userName, password, email');
            $this->db->where('id', $id);
            $rs = $this->db->get($this->tabla)->result();
            $usuario = '';
            if(count($rs) > 0){
                $usuario = $rs[0];
            }
            return $usuario;
        }

        public function getPorNick($nick)
        {
            $this->db->select('id, userName, password, email');
            $this->db->where('userName', $nick);
            $rs = $this->db->get($this->tabla)->result();
            $usuario = '';
            if(count($rs) > 0){
                $usuario = $rs[0];
            }
            return $usuario;
        }

        public function getCategoriaDeProductos($id)
        {
            $this->db->select('categoria_id');
            $this->db->from($this->tabla);
            $this->db->join('subasta', 'subasta.usuario_id = usuario.id');
            $this->db->join('producto', 'subasta.producto_id = producto.id');
            $this->db->join('producto_a_categoria', 'producto.id = producto_a_categoria.producto_id');
            $this->db->where('usuario.id', $id);
            $this->db->distinct();

            $query = $this->db->get();
            $categorias = array();
            if($query->num_rows() > 0){
                foreach ($query->result() as $res) :
                    $categoria = array('categoria' => $res->categoria_id);
                    $categorias[] = $categoria;
                endforeach;
            }
            return $categorias;
        }

        public function getUltimasSubastas($id)
        {
            $this->db->from($this->tabla);
            $this->db->join('subasta', 'subasta.usuario_id = usuario.id');
            $this->db->join('producto', 'subasta.producto_id = producto.id');
            $this->db->where('usuario.id', $id);
            $this->db->order_by('subasta.id','desc');
            $this->db->limit(10);

            $query = $this->db->get();
            return $query->result();
        }

        public function tieneTienda($usuario)
        {
            $this->db->from($this->tabla);
            $this->db->join('usuario_a_tienda', 'usuario.id = usuario_a_tienda.usuario_id');
            $this->db->where('usuario.id', $usuario['id']);

            $rs = $this->db->get()->result();
            return count($rs) > 0;
        }

        public function getTiendaId($usuario) {
            $this->db->from($this->tabla);
            $this->db->join('usuario_a_tienda', 'usuario.id = usuario_a_tienda.usuario_id');
            $this->db->where('usuario.id', $usuario['id']);

            $rs = $this->db->get()->result();
            $id = -1;
            if(count($rs) > 0){
                $id = $rs[0]->tienda_id;
            }
            return $id;
        }

        public function getTienda($usuario)
        {
            $this->db->select('tienda.*');
            $this->db->from($this->tabla);
            $this->db->join('usuario_a_tienda', 'usuario.id = usuario_a_tienda.usuario_id');
            $this->db->join('tienda', 'tienda.id = usuario_a_tienda.tienda_id');
            $this->db->where('usuario.id', $usuario['id']);

            $tienda = '';
            $rs = $this->db->get()->result();
            if(count($rs) > 0){
                $tienda = $rs[0];
            }

            return $tienda;
        }

        public function getTodo($id)
        {
            $this->db->where('id', $id);
            $rs = $this->db->get($this->tabla)->result();
            $usuario ='';
            if(count($rs) > 0) {
                $usuario = $rs[0];
            }
            return $usuario;
        }

        public function modificar($usuario)
        {
            $this->db->where('id', $usuario['id']);
            $this->db->update($this->tabla, $usuario);
        }
	}
 ?>