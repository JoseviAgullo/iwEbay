<?php $this->load->view("inc/cabecera.inc.php");
?>
<?php $this->load->view("inc/menuLateral.inc.php") ?>



	<div id="productos"  style="float:left">
		<?php echo $listado;?>
	</div>
</div>

	<div id="limpieza" style="clear:both;"></div> <!-- Este div es por si queremos después insertar algo debajo, que no se vaya al lado de lo otro -->


<?php 
	$this->load->view("inc/pie.inc.php")

 ?>