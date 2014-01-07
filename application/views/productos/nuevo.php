<?php $this->load->view("inc/cabecera.inc.php") ?>
<?php $this->load->view("inc/menuLateral.inc.php") ?>

<script>
    jQuery(function ($) {
        $.datepicker.regional['es'] = {
            yearRange: '-110:-18',
            defaultDate: '-18y',
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

<?php
$error = $this->session->flashdata('error_subasta');
if($error != '') {
    echo ('<hr> <p style="color:red">' . $error . '</p> <hr>');
}
?>


	<div id="detalles"  style="float:left">
		<?php $this->load->helper('html');
		$this->load->helper('form');
		echo form_open_multipart('productos/nuevoProd'); ?>
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
								<textarea id="descripcion_subasta" name="descripcion_subasta" placeholder="Una breve descripción de la subasta..."></textarea> 
							</td>
						</tr>
						<tr>
							<td>
								Fecha fin: 
							</td>							
						</tr>
						<tr>
							<td>
								<input type="date" name="fechaFinSubasta" placeholder="DD/MM/YYYY">
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" name="checkCompraYa"> Compra ya
							</td>
							<td>
								<div class="campoForm">
						        	<label for="descripcion">Inserte una imagen para el producto: </label> <br>
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
							<input type="text" name="nombreProductoSubasta" placeholder="Inserta el nombre de tu producto"> 
						</td>
						<td> </td>
						<td>
							<select name="estadoProductoSubasta">
								<!--<option value="-1" >seleccione una provincia...</option>-->
								<option value="Nuevo">Nuevo</option>
								<option value="Usado">Usado ligeramente</option>
								<option value="Gastado">Gastado/con uso</option>
								<option value="Roto">Roto</option>
							</select>
						</td>
						<td> </td>
						<td>
							<input type="number" name="cantidadProductoSubasta"> 
						</td>
					</tr>
					<tr>
						<td>
							Detalles
						</td>
						<td> </td>
						<td>
							Categoría
						</td>
					</tr>
					<tr>
						<td>
							<textarea id="detallesProductoSubasta" name="detallesProductoSubasta" placeholder="Cuenta algún detalle característico del producto..."></textarea>	
						</td>		
						<td> </td>				
						<td>
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
							Precio inicial (en €)
						</td>
						<td> </td>
						<td>
							<span id="textCompraYa">Precio ¡Compra Ya! (en €):</span>
						</td>
					</tr>
					<tr>
						<td>
							<input type="number" name="precioIniProductoSubasta">
						</td>
						<td> </td>
						<td>
							<input id="inputCompraYa" type="number" name="precioYaProductoSubasta">
						</td>
					</tr>
				</table>
			</fieldset>
			<fieldset>
				<legend>Datos de envío</legend>
				<table>
					<tr>
						<td>
							Tipo de envío
						</td>
						<td> </td>
						<td>
							Gastos de envío (en €):
						</td>
					</tr>
					<tr>
						<td>
							<select name="tipoEnvioProductoSubasta">
								<!--<option value="-1" >seleccione una provincia...</option>-->
								<option value="Urgente">Urgente (1-2 días laborables)</option>
								<option value="Rápido">Rápido (4-5 días laborables)</option>
								<option value="Normal">Normal (7-15 días laborables)</option>
								<option value="Gratuito">Gratuito (te va a salir hasta barba esperando)</option>
							</select>
						</td>
						<td> </td>
						<td>
							<input type="number" name="gastosEnvioProductoSubasta">
						</td>
					</tr>
					<tr>
						<td>
							Forma de pago:
						</td>
					</tr>
					<tr>
						<td>
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
				<input type="submit" value="Crear subasta"> <input type="button" value="Cancelar" onClick="#">
			</div>
		</form>
	</div>
</div>

<div id="limpieza" style="clear:both;"></div> <!-- Este div es por si queremos después insertar algo debajo, que no se vaya al lado de lo otro -->

<fieldset>
	Falta implementar método POST y que vuelva atrás el botón de cancelar
</fieldset>

<hr>
<?php echo $link_atras; ?>

<?php 
	$this->load->view("inc/pie.inc.php");
 ?>