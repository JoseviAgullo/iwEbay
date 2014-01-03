<?php 
$this->load->view("inc/cabecera.inc.php")

 ?>
<h2> ¡Crea una subasta! (falta funcionalidad aún)</h2>
<h4> Vende el producto que quieras, como quieras y cuando quieras. Para hacerlo sólo tienes que rellenar estos tres apartados y esperar a que te llueva el dinero</h4>

	<form action="crear_subasta" method="POST">
	<fieldset>
		<h3>Datos de la Subasta </h3>
		<div class="campoForm">
			<label for="desc">Descripción:  </label> <br>
			<textarea name="desc" cols="40" rows="5" placeholder="Cuentame tu vida...">
			</textarea>	
		</div>
		<div class "campoForm">
			<label for="f_fin">Fecha Fin: </label>
			<input type="date" name="f_fin" placeholder="DD/MM/YYYY" onBlur="comprobarFecha();">
		</div>

		<div class="campoForm">		
			<input type="checkbox" name="compra_ya"> !Compra Ya!
		</div>
		
		<button>Foto </button>
	</fieldset> <br>

	<fieldset>
		<h3>Datos del Producto</h3>
		<div class="campoForm" style="float:left;">
			<label for="nombre">Nombre:  </label> <br>
			<input type="text" name="nombre" placeholder="Objeto chachi...">
		</div>
		<div class="campoForm" style="float:left;">
			<label for="nombre">Estado:  </label> <br>
			<select name="nombre">
				<option value="nuevo">Nuevo</option>
				<option value="usado">Usado</option>
				<option value="usado">Restaurado en fábrica</option>
				<option value="usado">Restaurado por el vendedor</option>
				<option value="usado">Para desguace o que no funciona</option>
			</select>
		</div>

		<div class="campoForm" style="float:left;">
			<label for="cantidad">Cantidad:  </label> <br>
			<input type="number" name="cantidad" placeholder="Número de unidades...">
		</div>
		
		<div id="limpieza" style="clear:both;"></div> <!-- Este div es por si queremos después insertar algo debajo, que no se vaya al lado de lo otro -->
		
		<div class="campoForm" >
			<label for="det">Detalles:  </label> <br>
			<textarea name="det" cols="40" rows="5" placeholder="Cuenta lo maravilloso que es este producto...">
			</textarea>	
		</div>
		<div class="campoForm" style="float:left;">
			<label for="precio_bid">Precio Inicial (en €):  </label> <br>
			<input type="number" min="0.01" step="0.01" name="precio_bid" placeholder="Precio inicial">
		</div>

		<div class="campoForm" style="float:left;">
			<label for="precio_buy">Precio !Compra Ya! (en €):  </label> <br>
			<input type="number" min="0.01" step="0.01" name="precio_buy" placeholder="Precio YA">
		</div>
		<div class="campoForm" style="float:left;">
			<label for="cat">Categoría:  </label> <br>
			<select name="cat">
				<option value="nuevo">Vibradores</option>
				<option value="usado">Usado</option>
				<option value="usado">Restaurado en fábrica</option>
				<option value="usado">Restaurado por el vendedor</option>
				<option value="usado">Para desguace o que no funciona</option>
			</select>
		</div>
	</fieldset>

	<fieldset>
		<h3>Datos de Envío</h3>
		<div class="campoForm" style="float:left;">
			<label for="tipo_envio">Tipo de Envío:  </label> <br>
			<select name="tipo_envio">
				<option value="nuevo">Urgente (1-2 días)</option>
				<option value="usado">Normal (3-4 días)</option>
				<option value="usado">Gratuito</option>
				<option value="usado">Rumano en carro</option>
			</select>
		</div>
		<div class="campoForm" style="float:left;">
			<label for="gastos_envio">Gastos de Envío (en €):  </label> <br>
			<input type="number" min="0.01" step="0.01" name="gastos_envio" placeholder="Gastos de envío">
			
		</div>
		<div class="campoForm" style="float:left;">
			<label for="forma_pago">Forma de Pago:  </label> <br>
			<select name="forma_pago">
				<option value="nuevo">Paypal</option>
				<option value="usado">Contrareembolso</option>
				<option value="usado">Tarjeta de crédito/débito</option>
				<option value="usado">Bitcoins</option>
			</select>
		</div>
	</fieldset>
	<input type="submit" name="crear_subasta" value="Comenzar Subasta">
	<button type="cancel" value="Cancelar">Cancelar</button>
	</form>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>