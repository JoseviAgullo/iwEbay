<?php 
$this->load->view("inc/cabecera.inc.php")

 ?>

<h2> ¡Crea tu propia tienda!</h2>
<h4> Consigue que la gente adquiera tus productos de forma fácil y sencilla creando tu propia tienda en un instante.</h4>

<?php
$error = $this->session->flashdata('error');
if($error){
    echo('<hr> <p style="color:red">' . $error . '</p> <hr>');
}
?>
<form action="crear" method="POST">
	<fieldset>
		<div class="campoForm">
			<label for="nombre">Nombre de la tienda:  </label> <br>
			<input type="text" name="nombre"placeholder="Nombre de la tienda">
		</div>
		<div class="campoForm">
			<label for="descripcion">Descripcion: </label> <br>
			<textarea name="descripcion" placeholder="Una breve descripción de los que habrá en tu tienda y por qué la gente debería comprarte a ti." rows="4" cols="50"></textarea>
		</div>
	</fieldset>
	<input type="submit" name="crear_tienda" value="Crear Tienda">
	<input type="button" name="cancelar" value="Cancelar">
</form>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>