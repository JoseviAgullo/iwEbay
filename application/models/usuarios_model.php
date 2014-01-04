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
            $this->db->where('username', $nick);
            return $this->db->get($this->tabla);
        }

        
			
	}
 ?>