<?php 
$this->load->view("inc/cabecera.inc.php");

 ?>
<?php
echo '<h2>'. $tienda->nombre . '</h2>';
$this->load->view("inc/menuLateralTienda.inc.php");
?>



<div id="contenido" style="border-style:solid; border-width:1px; float:left; margin-left:10px; padding:3px;">
    <fieldset>
        <div id="imag" style="width:150px; height:150px; margin:3px; padding:3px;"> <?php echo $img_perfil ?></div>
        <?php
            echo('<p>Bienvenido a la tienda de ' . $usuario->userName . '</p>');
            echo('<p>'. $tienda->descripcion .'</p>');
            if($propietario != ''){
                echo anchor('tiendas/modificar/'.$tienda->id, 'Modificar tienda');
            }
        ?>
    </fieldset>
    <fieldset>
        <h2>Últimas Subastas </h2>
        <table>
            <thead>
            <tr>
                <th>Imagen</th><th>Nombre</th><th>Precio</th><th>Detalles</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($ultimas as $subasta) :?>
                <tr>
                    <td><?php echo img('images/producto/'.$subasta->producto_id.'_thumb.jpg' );?>  </td>
                    <td><?php echo $subasta->nombre; ?></td>
                    <td><?php echo $subasta->precio_compra_ya . '€' ?></td>
                    <td><?php echo anchor('productos/detalle/'.$subasta->producto_id, 'Detalles') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>

</div>

	<div id="limpieza" style="clear:both;"></div>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>