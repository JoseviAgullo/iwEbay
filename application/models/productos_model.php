<?php 
	class productos_model extends CI_Model {
		
		private $tabla = 'producto';

		function cuenta_todos(){
			return $this->db->count_all($this->tabla);
		}

		function cuenta_categoria($categoria){
			//falta el where
			$this->db->from($this->tabla);
			$this->db->join('producto_a_categoria', 'producto_a_categoria.producto_id = producto.id');
            $this->db->where('producto_a_categoria.categoria_id', $categoria);

			return $this->db->count_all($this->tabla);
		}

		function cuenta_destacados(){ 
			$this->db->from($this->tabla);
			$this->db->where('destacado', '1');			
        	$query = $this->db->get(); 

        	return $query->num_rows();
		}

		function listado(){
			$this->db->select('producto.*, subasta.fecha_fin');
			$this->db->from($this->tabla);
			$this->db->join('subasta', 'subasta.producto_id = producto.id');
			$this->db->order_by('nombre', 'asc');
			return $this->db->get()->result();
		}


		function listado_categoria($categoria){
			
			$this->db->select('producto.*, subasta.fecha_fin');
			$this->db->from($this->tabla);
			$this->db->join('subasta', 'subasta.producto_id = producto.id');
			$this->db->join('producto_a_categoria', 'producto_a_categoria.producto_id = producto.id');
			$this->db->join('categoria', 'producto_a_categoria.categoria_id = categoria.categoria');
            $this->db->where('categoria.categoria', $categoria);
			return $this->db->get()->result();
		}

		function listado_destacados(){

			$this->db->order_by('nombre', 'asc');
			$this->db->where('destacado', '1');
			return $this->db->get($this->tabla)->result();
		}

		function dameUno($id){
			$this->db->select('*');
			$this->db->from($this->tabla);
       		$this->db->join('subasta', 'subasta.producto_id = producto.id');            
            $this->db->join('usuario', 'subasta.usuario_id = usuario.id');
            $this->db->where('producto.id', $id);
                        
            $query = $this->db->get();
            $rs = $query->result();
            $producto = '';
            if(count($rs) > 0){
                $producto = $rs[0];
            }
            return $producto;	
		}

		function damePujaProd($id){
			$this->db->select('puja.cantidad');
			$this->db->from('puja');
			$this->db->join('subasta', 'subasta.id = puja.subasta_id');
			$this->db->join('producto', 'subasta.producto_id = producto.id');			
			$this->db->where('producto.id', $id);
			$this->db->order_by('puja.cantidad', 'desc');

			$query = $this->db->get();
            $rs = $query->result();
            $puja = '';
            if(count($rs) > 0){
                $puja = $rs[0];
            }
            return $puja;
		}

		function dameSubasta($id){
			$this->db->select('id');
			$this->db->from('subasta');
			$this->db->where('producto_id', $id);

			$query = $this->db->get();
            $rs = $query->result();
            $subasta = '';
            if(count($rs) > 0){
                $subasta = $rs[0];
            }
            return $subasta;				
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

        public function getProductosUsuario($id,$categoria)
        {
            $this->db->select('producto.nombre, producto.precio_inicial, subasta.fecha_fin, producto.id');
            $this->db->from($this->tabla);
            $this->db->join('subasta', 'subasta.producto_id = producto.id');
            $this->db->join('producto_a_categoria', 'producto_a_categoria.producto_id = producto.id');
            $this->db->where('subasta.usuario_id', $id);
            $this->db->where('producto_a_categoria.categoria_id', $categoria);

            return $this->db->get()->result();
        }

        public function productos_usuario($id)
        {
        	$this->db->from($this->tabla);
        	$this->db->join('subasta', 'subasta.producto_id = producto.id');
        	$this->db->where('subasta.usuario_id', $id);
        	return $this->db->get()->result();

        }
	}
 ?>