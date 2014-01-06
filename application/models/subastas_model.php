<?php 
	class subastas_model extends CI_Model {
		
		private $tabla = 'subasta';

		function insertaSubasta($auction){
			$this->db->insert($this->tabla, $auction);

			$id = $this->db->insert_id();

			return $id;	
		}	
	}
 ?>