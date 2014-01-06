<?php 
$this->load->view("inc/cabecera.inc.php");
$this->load->view("inc/menuLateral.inc.php"); 
 ?>
<?php

echo '<h2> Tienda de ' . anchor('usuarios/perfil/' . $usuario->userName ,$usuario->userName) . '</h2>'
?>


<div id="desc_tienda"  style="border-style:solid; border-width:1px; float:left; margin-left:10px; padding:3px;">
    <?php
    echo('<p>Bienvenido a la tienda de ' . $usuario->userName);
    echo('<p>'. $tienda->descripcion .'</p>')
    ?>


</div>

<div id="ultimas_subastas"  style="border-style:solid; border-width:1px; float:left; margin-left:10px; padding:3px;">
	<h2 style="float:center;">Últimas Subastas </h2>
    <!-- empieza la tabla
    <?php foreach($ultimas as $subasta) :?>
        cada una de las filas de la tabla que sea una de las ultimas subastas
    <?php endforeach; ?>
    acaba la tabla-->
</div>

	<div id="limpieza" style="clear:both;"></div>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>