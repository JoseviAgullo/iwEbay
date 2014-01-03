<?php 
$this->load->view("inc/cabecera.inc.php")

 ?>

<form action="registrar" method="POST">
	<fieldset>
		<div class="campoForm">
			<label for="nick">Nombre usuario: *</label> <br>
			<input type="text" name="nick" placeholder="Introduce tu nombre de usuario...">		
		</div>
		<div class="campoForm">
			<label for="email">Email: *</label> <br>
			<input type="text" name="email" placeholder="Introduce tu correo electrónico...">		
		</div>
		<div class="campoForm">
			<label for="password">Contraseña: *</label> <br>
			<input type="password" name="password" placeholder="Introduce tu contraseña...">		
		</div>
		<div class="campoForm">
			<label for="conf_password">Confirmar contraseña: *</label> <br>
			<input type="password" name="conf_password" placeholder="Confirme su contraseña...">		
		</div>
	</fieldset><br><!-- Más adelante eliminar los br y maquetar por cs3 -->

	<fieldset>
		<div class="campoForm">
			<label for="dir">Dirección: </label> <br>
			<input type="text" name="dir" placeholder="Introduce tu dirección...">		
		</div>
		<div class="campoForm">
			<label for="tlf">Teléfono: </label> <br>
			<input type="text" name="tlf" placeholder="Introduce tu teléfono...">		
		</div>
		<div class="campoForm">
			<label for="f_nacimiento">Fecha de Nacimiento: *</label> <br>
			<input type="date" name="f_nacimiento" placeholder="Introduce tu fecha de nacimiento...">		
		</div>
	</fieldset>
	<input type="checkbox" name="tos"> Acepto los <?php echo anchor('usuario/tos','Términos y condiciones de uso') ?> <br> 
	<input type="checkbox" name="news"> Mantenme informado de las novedades <br> 
	<input type="submit" name="submit" value="Registrarse"> <!-- AQUÍ VA EL MENSAJE DE ERROR -->
</form>



<?php
	$this->load->view("inc/pie.inc.php")
?>