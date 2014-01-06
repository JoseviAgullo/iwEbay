<?php 
	class votos_model extends CI_Model {
		private $tabla = 'voto';

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





			
	}
 ?>