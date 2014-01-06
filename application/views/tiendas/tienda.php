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
    <table>
        <thead>
            <tr>
                <th>Imagen</th><th>Nombre</th><th>Precio</th><th>Detalles</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($ultimas as $subasta) :?>
            <tr>
                <td><img src="imagenes/productos/default.jpg"></td>
                <td><?php echo $subasta->nombre; ?></td>
                <td><?php echo $subasta->precio; ?></td>
                <td><?php echo anchor('productos/detalles'.$subasta->producto_id, 'Detalles') ?></td>
            </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>

	<div id="limpieza" style="clear:both;"></div>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>