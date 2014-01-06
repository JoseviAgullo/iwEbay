<?php 
	class categoria_model extends CI_Model {
		
		private $tabla = 'categoria';

		function getCategorias(){
			$sql = $this->db->query('SELECT * FROM categoria');
			//$sql = $this->db->get('categoria');

			if($sql->num_rows() > 0){
				foreach ($sql->result() as $res) :
                    $categoria = array('categoria' => $res->categoria);
					$menu[] = $categoria;
				endforeach;
			}

			//$menu = $this->db->query("SELECT * FROM ".$tabla);
			return $menu;
		}
	}
 ?>