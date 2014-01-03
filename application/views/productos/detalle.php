<?php $this->load->view("inc/cabecera.inc.php") ?>
<?php $this->load->view("inc/menuLateral.inc.php") ?>




<div id="detalles"  style="float:left">
		



		<table>
			<tr>
				<td>Aquí va la foto</td>
				<td>
					<?php echo $tupla->nombre; ?><br>
						
					Nombre Usuario<br>
					
					Enlace a la tienda<br>
				</td>
			</tr>
			<tr>
			</tr>
			<tr>
				<td>Precio actual:<br> (muestra inicial solo, OJO!) </td>
				<td style="font-weight:bold"><?php echo $tupla->precio_inicial; ?></td>
			</tr>
			<tr>
				<td>Fecha finalización: </td>
				<td style="font-weight:bold">Mañana</td>
			</tr>
			<tr>
				<td>INPUT de la puja</td>
				<td style="font-weight:bold">BOTÓN pujar	</td>
			</tr>
			<tr>
			</tr>
			<tr>
				<td>
					Descripción del producto:	
				</td>
			</tr>
			<tr>
				<td>
					Aquí va la descripción
				</td>
			</tr>
			<tr>
				<td>
					Detalles de envío:	
				</td>
			</tr>
			<tr>
				<td>
					Aquí van los detalles
				</td>
			</tr>
			<tr>
				<td>
					Condiciones de la venta:	
				</td>
			</tr>
			<tr>
				<td>
					Aquí van las condiciones
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="limpieza" style="clear:both;"></div> <!-- Este div es por si queremos después insertar algo debajo, que no se vaya al lado de lo otro -->


<hr>
<?php echo $link_atras; ?>

<?php 
	$this->load->view("inc/pie.inc.php");
 ?>