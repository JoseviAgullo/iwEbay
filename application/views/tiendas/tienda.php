<?php 
$this->load->view("inc/cabecera.inc.php");
$this->load->view("inc/menuLateral.inc.php"); 
 ?>
<?php echo '<h2> Tienda de ' . anchor('usuarios/perfil','Usuario 1') . '</h2>'   ?>


<div id="desc_tienda"  style="border-style:solid; border-width:1px; float:left; margin-left:10px; padding:3px;">
	<p>Bienvenido a la tienda del Usuario 1</p>
	<p>Aquí podrá ver una descripción de la tienda y todo lo que quiera poner el usuario</p>

</div>

<div id="ultimas_subastas"  style="border-style:solid; border-width:1px; float:left; margin-left:10px; padding:3px;">
	<h2 style="float:center;">Últimas Subastas </h2>
</div>

	<div id="limpieza" style="clear:both;"></div>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>