<?php 
$this->load->view("inc/cabecera.inc.php")

 ?>
<h2> ¡Crea una subasta! (falta funcionalidad aún)</h2>
<h4> Vende el producto que quieras, como quieras y cuando quieras. Para hacerlo sólo tienes que rellenar estos tres apartados y esperar a que te llueva el dinero</h4>

	<form action="crear_subasta" method="POST">
	<fieldset>
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
	</fieldset> <br>

	<fieldset>
		<div class="campoForm">
			<label for="nombre">Nombre:  </label> <br>
			<input type="text" name="nombre" placeholder="Objeto chachi...">
		</div>
		<div class="campoForm">
			<label for="nombre">Estado:  </label> <br>
			<select name="nombre">
				<option value="nuevo">Nuevo</option>
				<option value="usado">Usado</option>
			</select>
		</div>

	</form>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>