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
						<td><div id="imag" style="width:150px; height:150px; border-style:solid; border-width:1px; margin:3px; padding:3px;"> <?php echo $img_perfil ?></div></td>
						<td>
							<font size="6"><?php echo $tupla->nombre; ?></font>			
							<br>
							<?php echo '<input type="hidden" id="id_pet" name="id_pet" value="'.$tupla->producto_id.'">'; ?> 
							<br>						
							<?php echo anchor('usuarios/perfil/'.$tupla->id, $tupla->userName); ?><br>							
							<?php if($tienda != ''){
								echo anchor('tiendas/tienda/'.$tienda->id, 'Visita la tienda de este usuario<br>');
							} ?>
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
						<td>
                            <?php
                            date_default_timezone_set('UTC');
                            echo date("d-m-Y", strtotime($tupla->fecha_fin));
                            ?>
                        </td>
					</tr>
					
					<tr>						 
						<?php  if($usuario = $this->session->userdata('usuario'))
                			{ 
                				echo '<td>';
                				echo '<input type="number" id="valor_puja" name="valor_puja"> <br>';

								echo '<span>Introduce '; 
								if($puja == ''){
       					   			echo $tupla->precio_inicial + 1;
       							} 
       							else{        								
        							echo $puja->cantidad + 1;
       							} 
       							echo ' o más</span>';
       							echo '</td>';
								echo '<td> <input type="submit" value="Pujar"> </td>';
       						}
       						
       					?>
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



<hr>
<?php echo $link_atras; ?>

<?php 
	$this->load->view("inc/pie.inc.php");
 ?>