<?php 
	class votos_model extends CI_Model {
		private $tabla = 'voto';

		//Realiza un voto positivo
		public function votar_positivo($origen, $destino, $desc)
        {
           $voto = array(
			   'positivo' => '1' ,
			   'comentario' => $desc ,
			   'votante_id' => $origen,
			   'votado_id' => $destino
			);

			$this->db->insert($this->tabla, $voto);
			$id = $this->db->insert_id();

			return $id;	
        }

        //Realiza un voto negativo
        public function votar_negativo($origen, $destino, $desc)
        {
	         $voto = array(
				   'positivo' => '0' ,
				   'comentario' => $desc ,
				   'votante_id' => $origen,
				   'votado_id' => $destino
				);

				$this->db->insert($this->tabla, $voto);
				$id = $this->db->insert_id();

				return $id;	   
        }

        //Devuelve la cantidad de votos positivos
        public function votos_positivos($id)
        {
            $this->db->from($this->tabla);
            $this->db->where('positivo', '1');
            $this->db->where('votado_id', $id);
        	$query = $this->db->get(); 

        	return $query->num_rows();
        }

        public function cuenta_todos($id)
        {
        	$this->db->from($this->tabla);
            $this->db->where('votado_id', $id);
        	$query = $this->db->get(); 

        	return $query->num_rows();
        }





			
	}
 ?>