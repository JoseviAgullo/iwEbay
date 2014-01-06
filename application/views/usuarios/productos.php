<?php $this->load->view("inc/cabecera.inc.php");
echo '<h1>' . $tienda->nombre . '</h1>';
$this->load->view("inc/menuLateralTienda.inc.php") ?>


    <fieldset>
        <?php
        echo('<p>Bienvenido a la tienda de ' . $usuario->userName . '</p>');
        echo('<p>'. $tienda->descripcion .'</p>')
        ?>
    </fieldset>
    <fieldset>
        <div id="productos"  style="float:left">
            <?php echo $listado;?>
        </div>
    </fieldset>
</div>

<div id="limpieza" style="clear:both;"></div> <!-- Este div es por si queremos después insertar algo debajo, que no se vaya al lado de lo otro -->


<?php $this->load->view("inc/pie.inc.php") ?>