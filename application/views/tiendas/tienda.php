<?php 
$this->load->view("inc/cabecera.inc.php");

 ?>
<?php
echo '<h2>'. $tienda->nombre . '</h2>';
$this->load->view("inc/menuLateralTienda.inc.php");
?>


<div id="desc_tienda"  style="border-style:solid; border-width:1px; float:left; margin-left:10px; padding:3px;">
    <?php
    echo('<p>Bienvenido a la tienda de ' . $usuario->userName . '</p>');
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
                <td><?php echo $subasta->precio_compra_ya . '€' ?></td>
                <td><?php echo anchor('usuarios/'.$subasta->producto_id, 'Detalles') ?></td>
            </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>

	<div id="limpieza" style="clear:both;"></div>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>