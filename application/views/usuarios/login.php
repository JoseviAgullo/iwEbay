<?php 
$this->load->view("inc/cabecera.inc.php");
 ?>
<?php
$error = $this->session->flashdata('error_login');
if($error != '') {
    echo ('<hr> <p style="color:red">' . $error . '</p> <hr>');
}
?>
<form action="do_login" method="POST">
	<fieldset>
		<div class="campoForm">
			<label for="nick">Nombre usuario: </label> <br>
			<input type="text" name="nick" placeholder="Introduce tu nombre de usuario...">		
		</div>
		<div class="campoForm">
			<label for="password">Contraseña: </label> <br>
			<input type="password" name="password" placeholder="Introduce tu contraseña...">		
		</div>
	</fieldset>
	<input type="checkbox" name="recordar"> Recordar mis datos <br> 
	<input type="submit" name="submit" value="Acceder"> <!-- AQUÍ VA EL MENSAJE DE ERROR -->
</form>
<?php
echo anchor('usuario/recuperarContraseña','Recuperar contraseña');
echo ' ';
echo anchor('','Volver atrás')
?>


<?php
	$this->load->view("inc/pie.inc.php")
 ?>