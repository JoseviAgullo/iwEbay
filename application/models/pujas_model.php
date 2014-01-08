<?php 
	class pujas_model extends CI_Model {
		private $tabla = 'puja';

		function insertaPuja($puja){
			$this->db->insert($this->tabla, $puja);

			$id = $this->db->insert_id();

			return $id;	
		}	
	}
 ?>