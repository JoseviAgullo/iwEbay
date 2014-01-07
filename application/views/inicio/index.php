<?php $this->load->view("inc/cabecera.inc.php") ?>
<?php $this->load->view("inc/menuLateral.inc.php") ?>



	<div id="Destacados"  style="border-style:solid; border-width:1px; float:left; margin-left:10px; padding:3px;">
		<h2>Productos Destacados</h2>
		<?php 
		if(empty($listado_destacados))
			{
				echo 'No se han encontrado productos destacados';
			}
			else
			{
				foreach ($listado_destacados as $row)
				{
					echo '<div class="item_destacado" style="border-style:solid; border-width:1px; margin:3px; padding:3px; width:300px">'. img('images/producto/'.$row->id.'_thumb.jpg' )
							.'<br>'. $row->nombre . ' - ' .$row->precio_inicial .'€</p>' . anchor('productos/detalle/'.$row->id , 'Detalles'). ' </div>';
				}
			}
		?>
</div>

	<div id="limpieza" style="clear:both;"></div> <!-- Este div es por si queremos después insertar algo debajo, que no se vaya al lado de lo otro -->

	<?php echo anchor('productos/', 'Ver todos los productos'); ?>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>