<?php 
	class tiendas_model extends CI_Model {
        private $tabla = 'tienda';

        public function getTienda($id)
        {
            $this->db->where('id',$id);
            $query = $this->db->get($this->tabla);
            $rs = $query->result();

            if(count($rs) > 0) {
                $tienda = $rs[0];
            } else {
                $tienda = '';
            }

            return $tienda;
        }

        public function getUsuario($id)
        {
            $this->db->select('usuario.*');
            $this->db->join('usuario_a_tienda', 'usuario_a_tienda.tienda_id = tienda.id');
            $this->db->join('usuario', 'usuario_a_tienda.usuario_id = usuario.id');
            $this->db->where('tienda.id', $id);
            $query = $this->db->get($this->tabla);
            $rs = $query->result();

            if(count($rs) > 0){
                $usuario = $rs[0];
            } else {
                $usuario = '';
            }

            return $usuario;
        }

        public function crear($tienda,$usuario)
        {
            $nueva_tienda = array();
            $nueva_tienda['nombre'] = $tienda['nombre'];
            $nueva_tienda['descripcion'] = $tienda['descripcion'];

            $this->db->insert($this->tabla,$nueva_tienda);
            $tienda_id = $this->db->insert_id();

            $user_tienda = array('usuario_id' => $usuario['id'],
                                 'tienda_id' => $tienda_id);

            $this->db->insert('usuario_a_tienda', $user_tienda);

            return $tienda_id;
        }

        public function getUsuarioId($id)
        {
            $this->db->select('usuario_a_tienda.usuario_id');
            $this->db->from($this->tabla);
            $this->db->join('usuario_a_tienda','usuario_a_tienda.tienda_id = tienda.id');
            $this->db->where('tienda.id',$id);

            $rs = $this->db->get()->result();

            $user_id= -1;
            if(count($rs) > 0){
                $user_id = $rs[0]->usuario_id;
            }
            return $user_id;
        }

        public function modificarTienda($tienda)
        {
            $this->db->where('id', $tienda['id']);
            $this->db->update($this->tabla, $tienda);
        }
	}
 ?>