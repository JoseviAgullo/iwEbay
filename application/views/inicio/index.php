<?php $this->load->view("inc/cabecera.inc.php") ?>
<?php $this->load->view("inc/menuLateral.inc.php") ?>



	<div id="Destacados"  style="border-style:solid; border-width:1px; float:left">
		<h2>Productos Destacados</h2>
		<div class="item_destacado" style="border-style:solid; border-width:1px; margin:3px; width:150px">
			imagen aquí
			<p>Producto 1</p>
		</div>
		<div class="item_destacado" style="border-style:solid; border-width:1px; margin:3px; width:150px">
			imagen aquí
			<p>Producto 2</p>
		</div>
		<div class="item_destacado" style="border-style:solid; border-width:1px; margin:3px; width:150px">
			imagen aquí
			<p>Producto 3</p>
		</div>
	</div>
</div>

	<div id="limpieza" style="clear:both;"></div> <!-- Este div es por si queremos después insertar algo debajo, que no se vaya al lado de lo otro -->


<?php 
	$this->load->view("inc/pie.inc.php")

 ?>