<?php 
	class productos_model extends CI_Model {
		
		private $tabla = 'producto';

		function cuenta_todos(){
			return $this->db->count_all($this->tabla);
		}

		function cuenta_categoria($categoria){
			//falta el where
			return $this->db->count_all($this->tabla);
		}

		function cuenta_destacados(){
			$this->db->where('destacado', '1');
			return $this->db->count_all($this->tabla);
		}

		function listado(){

			$this->db->order_by('nombre', 'asc');
			return $this->db->get($this->tabla)->result();
		}


		function listado_categoria($categoria){
			$this->db->order_by('nombre', 'desc');
			return $this->db->get($this->tabla)->result();
		}

		function listado_destacados(){

			$this->db->order_by('nombre', 'asc');
			$this->db->where('destacado', '1');
			return $this->db->get($this->tabla)->result();
		}

		function dameUno($id){
			$this->db->where('id', $id);
			return $this->db->get($this->tabla);
		}

		function insertaProd($prod){
			$this->db->insert($this->tabla, $prod);

			$id = $this->db->insert_id();

			return $id;	
		}	

		function guardarCategProd($datos)
		{
			$this->db->insert('producto_a_categoria', $datos);
		}
	}
 ?>