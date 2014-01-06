<?php $this->load->view("inc/cabecera.inc.php") ?>
<?php $this->load->view("inc/menuLateral.inc.php");
	$this->load->helper('form'); ?>

<?php
$error = $this->session->flashdata('error_puja');
if($error != '') {
    echo ('<hr> <p style="color:red">' . $error . '</p> <hr>');
}
?>


<div id="detalles"  style="float:left">
	<?php echo form_open('pujas/pujar/'. $tupla->producto_id);
		?>
		<fieldset>
			<div class="detalles_prod">
				<table>
					<tr>
						<td>Aquí va la foto</td>
						<td>
							<font size="6"><?php echo $tupla->nombre; ?></font>			
							<br>
							<?php echo '<input type="hidden" id="id_pet" name="id_pet" value="'.$tupla->producto_id.'">'; ?> 
							<br>						
							<?php echo anchor('usuarios/perfil/'.$tupla->id, $tupla->userName); ?><br>
							Enlace a la tienda<br>
						</td>
					</tr>
				</table>
			</div>
		</fieldset>
		<fieldset>
			<div class="detalles_prod">
				<table>
					<tr>
						<td style="font-weight:bold">Precio actual:</td>
						<td><?php   if($puja == ''){
        					   			echo $tupla->precio_inicial.' €';
        					   			echo '<input type="hidden" id="valor_min_puja" name="valor_min_puja" value="'.$tupla->precio_inicial.'">';
        							} 
        							else{
        								echo $puja->cantidad.' €';
        								echo '<input type="hidden" id="valor_min_puja" value="'.$puja->cantidad.'">';
        							}
        					?>
        					<input type="hidden" name="valor_min_puja" value="<?php if($puja == ''){
        					   			echo $tupla->precio_inicial;        					   			
        							} 
        							else{
        								echo $puja->cantidad;
        							} ?>">
        				</td>
					</tr>
					<tr>
						<td style="font-weight:bold">Fecha finalización: </td>
						<td><?php echo date("d-m-Y", strtotime($tupla->fecha_fin)); ?></td>
					</tr>
					<tr>
						<td> 
							<input type="number" id="valor_puja" name="valor_puja"> <br>
							<span>Introduce <?php if($puja == ''){
        					   			echo $tupla->precio_inicial + 1;
        							} 
        							else{        								
        								echo $puja->cantidad + 1;
        							} ?> o más</span>
					 	</td>
						<td> <input type="submit" value="Pujar"> </td>
					</tr>
				</table>
			</div>
		</fieldset>
		<fieldset>
			<table>
				<tr>
					<td style="font-weight:bold">
						Descripción del producto:	
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $tupla->detalles; ?>
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold">
						Detalles de envío:	
					</td>
					<td> </td>
					<td style="font-weight:bold">
						Gastos de envío:
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $tupla->tipo_envio; ?>
					</td>
					<td> </td>
					<td>
						<?php echo $tupla->gastos_envio; ?> €
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold">
						Condiciones de la venta:	
					</td>
				</tr>
				<tr>
					<td>
						Aquí van las condiciones
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
	</div>
</div>

<div id="limpieza" style="clear:both;"></div> <!-- Este div es por si queremos después insertar algo debajo, que no se vaya al lado de lo otro -->

<fieldset>
	Falta implementar método POST
</fieldset>

<hr>
<?php echo $link_atras; ?>

<?php 
	$this->load->view("inc/pie.inc.php");
 ?>