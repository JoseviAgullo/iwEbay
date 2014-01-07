<?php 
	class subastas_model extends CI_Model {
		
		private $tabla = 'subasta';

		function insertaSubasta($auction)
        {
			$this->db->insert($this->tabla, $auction);

			$id = $this->db->insert_id();

			return $id;	
		}

        function modificar($subasta)
        {
            $this->db->where('id',$subasta['id']);
            $this->db->update($this->tabla,$subasta);
        }
	}
 ?>