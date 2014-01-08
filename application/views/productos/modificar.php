<?php $this->load->view("inc/cabecera.inc.php") ?>
    <h2> Modifica tu subasta</h2>
<?php $this->load->view("inc/menuLateral.inc.php") ?>


<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    jQuery(function ($) {
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié;', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
    });
    $(function () {
        $("#datepicker").datepicker({
            firstDay: 1
        });
    });
</script>
<script type="text/javascript">
    function cambiarPrecioYa() {
        precio = document.getElementById('inputCompraYa');
        precio.disabled = !document.getElementById('compraYa').checked;
    }
</script>

<?php
date_default_timezone_set('UTC');
$error = $this->session->flashdata('error_subasta');
if($error != '') {
    echo ('<hr> <p style="color:red">' . $error . '</p> <hr>');
}
?>


	<div id="detalles"  style="float:left">
		<?php $this->load->helper('html');
		$this->load->helper('form');
		echo form_open_multipart('productos/do_modificar/'.$producto->producto_id); ?>
			<fieldset>
				<legend>Datos de la subasta</legend>
				<div id = "datosForm">
					<table>
						<tr>
							<td>
								Descripción: 
							</td>							
						</tr>
						<tr>
							<td>
								<textarea id="descripcion_subasta" name="descripcion_subasta" placeholder="Una breve descripción de la subasta..."><?php echo $producto->descripcion ?></textarea>
							</td>
						</tr>
						<tr>
							<td>
								Fecha fin: 
							</td>							
						</tr>
						<tr>
							<td>
								<input id="datepicker" type="date" name="fechaFinSubasta" placeholder="DD/MM/YYYY" value="<?php echo date('d-m-Y',strtotime($producto->fecha_fin)) ?>">
							</td>
						</tr>
						<tr>
							<td>
								<input id="compraYa" type="checkbox" name="checkCompraYa" onclick="cambiarPrecioYa();"> Compra ya
							</td>
							<td>
								<div class="campoForm">
						        	<label for="userfile">Inserte una imagen para el producto: </label> <br>
						        	<input type="file" name="userfile" size="20" />
									<br /><br />
						        </div>
						    </td>
						</tr>
					</table>
				</div>	
			</fieldset>
			<fieldset>
				<legend>Datos del producto</legend>
				<table>
					<tr>
						<td>
							Nombre:
						</td>
						<td> </td>
						<td>
							Estado:
						</td>
						<td> </td>
						<td>
							Cantidad:
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="nombreProductoSubasta" placeholder="Inserta el nombre de tu producto" value="<?php echo $producto->nombre ?>">
						</td>
						<td> </td>
						<td>
							<select name="estadoProductoSubasta">
								<option value="Nuevo">Nuevo</option>
								<option value="Usado">Usado ligeramente</option>
								<option value="Gastado">Gastado/con uso</option>
								<option value="Roto">Roto</option>
							</select>
						</td>
						<td> </td>
						<td>
							<input type="number" name="cantidadProductoSubasta" value="<?php echo $producto->cantidad ?>">
						</td>
					</tr>
					<tr>
						<td>
                            <label for="detallesProductoSubasta">Detalles:</label><br>
							<textarea id="detallesProductoSubasta" name="detallesProductoSubasta" placeholder="Cuenta algún detalle característico del producto..."><?php echo $producto->detalles ?></textarea>
						</td>		
						<td> </td>				
						<td>
                            <label for="categoriaProductoSubasta">Categoría:</label><br>
							<select name="categoriaProductoSubasta">
								<?php 
									foreach ($categorias as $fila){
										echo '<option value="'.$fila['categoria'].'">'.$fila['categoria'].'</option>';										
									}
								?>								
							</select>
						</td>
					</tr>
					<tr>
						<td>
                            <label for="precioIniProductoSubasta">Precio inicial (en €)</label><br>
							<input type="number" name="precioIniProductoSubasta" value="<?php echo $producto->precio_inicial ?>">
						</td>
						<td> </td>
						<td>
                            <label for="precioYaProductoSubasta">Precio ¡Compra Ya! (en €):</label><br>
							<input id="inputCompraYa" type="number" name="precioYaProductoSubasta" disabled value="<?php echo $producto->precio_compra_ya ?>">
						</td>
					</tr>
				</table>
			</fieldset>
			<fieldset>
				<legend>Datos de envío</legend>
				<table>
					<tr>
						<td>
                            <label for="tipoEnvioProductoSubasta">Tipo de envío</label><br>
							<select name="tipoEnvioProductoSubasta">
								<option value="Urgente">Urgente (1-2 días laborables)</option>
								<option value="Rápido">Rápido (4-5 días laborables)</option>
								<option value="Normal">Normal (7-15 días laborables)</option>
								<option value="Gratuito">Gratuito (te va a salir hasta barba esperando)</option>
							</select>
						</td>
						<td> </td>
						<td>
                            <label for="gastosEnvioProductoSubasta">Gastos de envío (en €):</label><br>
							<input type="number" name="gastosEnvioProductoSubasta" value="<?php echo $producto->gastos_envio ?>">
						</td>
					</tr>
					<tr>
						<td>
                            <label for="formaPagoProductoSubasta">Forma de pago:</label><br>
							<select name="formaPagoProductoSubasta">						
								<option value="PayPal">PayPal</option>
								<option value="TCredito">Tarjeta de crédito</option>
								<option value="Transferencia">Transferencia</option>
								<option value="ContraR">Contrareembolso</option>
							</select>
						</td>
					</tr>
				</table>
			</fieldset>
			
			<div class="campoForm">
				<input type="submit" value="Modificar subasta"> <?php echo anchor('productos/borrar/'.$producto->producto_id , 'Cancelar Subasta', array('onclick'=>"return confirm('La subasta se cerrará y no venderás el producto. ¿Estás seguro?')")); ?> <?php echo anchor('productos/detalle/'.$producto->producto_id,'Atrás') ?>
			</div>
		</form>
	</div>
</div>

<div id="limpieza" style="clear:both;"></div> <!-- Este div es por si queremos después insertar algo debajo, que no se vaya al lado de lo otro -->

<?php 
	$this->load->view("inc/pie.inc.php");
 ?>