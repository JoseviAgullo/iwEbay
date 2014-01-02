<?php 
$this->load->view("inc/cabecera.inc.php")

 ?>

<form action="login.php" method="POST">
	<fieldset>
		<div class="campoForm">
			<label>Nombre usuario: </label> <br>
			<input type="text" name="nick" placeholder="Introduce tu nombre de usuario...">		
		</div>
		<div class="campoForm">
			<label>Contraseña: </label> <br>
			<input type="password" name="password" placeholder="Introduce tu contraseña...">		
		</div>
	</fieldset>
	<input type="checkbox" name="recordar"> Recordar mis datos <br> 
	<input type="submit" name="submit" value="Acceder"> <!-- AQUÍ VA EL MENSAJE DE ERROR -->
</form>
<a href="#">Recuperar contraseña</a>
<a href="/ebay">Volver atrás</a>



<?php

function login(){

	$usuario = $_POST["nick"];
	$password = $_POST["password"];

	if(sesion::comprobar($usuario, $password)){
		sesion::crear($usuario);	
		sesion::saltar_a("privada.php");
	}
	else{	
		$error = "Usuario o contraseña incorrectos";

		//echo ("patata");
		//sesion::saltar_a("login.php");
	}
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	login();
}


	$this->load->view("inc/pie.inc.php")

 ?>