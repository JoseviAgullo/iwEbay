<?php 
$this->load->view("inc/cabecera.inc.php")

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
//Esta función deberá estar en el controlador de usuarios
//2 funciones: una encargada de renderizar la vista (comprobar si está logueado ya o no...)
//             otra encargada de realizar el login en si
//hay que tratar que haya la menor cantidad de código fuera de los controladores y los modelos.
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