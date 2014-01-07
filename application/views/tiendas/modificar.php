<?php 
$this->load->view("inc/cabecera.inc.php")

 ?>

<h2>Modifica tu tienda</h2>

<?php
$error = $this->session->flashdata('error');
if($error){
    echo('<hr> <p style="color:red">' . $error . '</p> <hr>');
}
?>
<?php
$this->load->helper('form');
echo form_open('tiendas/do_modificar/'.$tienda->id);
?>
	<fieldset>
		<div class="campoForm">
			<label for="nombre">Nombre de la tienda: *  </label> <br>
			<input type="text" name="nombre"placeholder="Nombre de la tienda" value="<?php echo $tienda->nombre ?>">
		</div>
		<div class="campoForm">
			<label for="descripcion">Descripcion: * </label> <br>
			<textarea name="descripcion" placeholder="Una breve descripción de los que habrá en tu tienda y por qué la gente debería comprarte a ti." rows="4" cols="50"><?php echo $tienda->descripcion ?></textarea>
        </div>
	</fieldset>
	<input type="submit" name="modificiar" value="Modificar Tienda">
	<input type="button" name="cancelar" value="Cancelar">
</form>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>