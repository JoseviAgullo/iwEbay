<?php $this->load->view("inc/cabecera.inc.php") ?>
<?php $this->load->view("inc/menuLateral.inc.php") ?>




<div id="detalles"  style="float:left">
	<form action="registrar" method="POST">
		<fieldset>
			<div class="detalles_prod">
				<table>
					<tr>
						<td>Aquí va la foto</td>
						<td>
							<font size="6"><?php echo $tupla->nombre; ?></font>			
							<br>
							<br>						
							<?php echo anchor('usuarios/perfil/'.$tupla->userName, $tupla->userName); ?><br>
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
						<td><?php echo $tupla->precio_inicial; ?></td>
					</tr>
					<tr>
						<td style="font-weight:bold">Fecha finalización: </td>
						<td><?php echo date("d-m-Y", strtotime($tupla->fecha_fin)); ?></td>
					</tr>
					<tr>
						<td> 
							<input type="number" id="valor_puja" name="valor_puja"> <br>
							<span>Introduce <?php echo $tupla->precio_inicial; ?> o más</span>
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
	Falta implementar método POST y que el precio actual muestre el precio de la ultima puja, es decir, el precio actual real
</fieldset>

<hr>
<?php echo $link_atras; ?>

<?php 
	$this->load->view("inc/pie.inc.php");
 ?>