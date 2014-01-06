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

        public function getUsuario($nick)
        {
            $this->db->select('id, userName, password, email');
            $this->db->where('username', $nick);
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
            return $query->result();
        }

        public function getUltimasSubastas($id)
        {
            $this->db->from($this->tabla);
            $this->db->join('subasta', 'subasta.usuario_id = usuario.id');
            $this->db->join('producto', 'subasta.producto_id = producto.id');
            $this->db->where('usuario.id', $id);
            $this->db->order_by('subasta.fecha_inicio','asc');
            $this->db->limit(10);

            $query = $this->db->get();
            return $query->result();
        }
			
	}
 ?>