<?php 
$this->load->view("inc/cabecera.inc.php"); 
$this->load->helper('form');
$this->load->helper('file');
?>
<div id="lateral"style="width:180px; border-style:solid; border-width:1px; margin:3px; float:left; margin:10px; padding:3px;">
	

		<?php echo form_open_multipart('usuarios/subir_imagen/2');?>
		<input type="file" name="userfile" size="20" />
		<br /><br />
		<input type="submit" value="upload" />
		</form>

	
	<div id="imag" style="width:150px; height:150px; border-style:solid; border-width:1px; margin:3px; padding:3px;"> imagen</div>
	<h3 id="user"> <?php echo $tupla->userName ?> </h3>
	<?php echo anchor('tiendas/tienda/'. $tienda,'Ver Tienda') ?>
	<p id = "email">Email: <?php echo $tupla->email ?></p>
	<p id = "votos">Votos Positivos: <?php echo $cantidad_positivos . ' de '. $cantidad_total ?></p>
</div>

<div class="campoForm">
	<?php 
		$votoOk = $this->session->flashdata('votoOK');
		if($votoOk != '') {
	    	echo ('<hr> <p style="color:blue">' . $votoOk . '</p> <hr>');
		}
	
		echo form_open('votos/votar/'. $tupla->id);
		?>

		<?php
			if($usuario = $this->session->userdata('usuario'))
        	{

			echo('<label for="desc">Recomienda a '. $tupla->userName . ':  </label> <br>
			<textarea name="desc" cols="40" rows="5" placeholder="¡Comenta tu voto!">
			</textarea>');	
			
				echo('<button id="env_voto" name="env_voto" value="posi">Positivo</button>');
				echo('<button id="env_voto" name="env_voto" value="nega">Negativo</button>');
			 echo form_close();
			 } ?>
		</div>
		<div class="campoForm">
			<label for="desc">Listado de productos:  </label> <br>
			<textarea name="desc" cols="40" rows="5" placeholder="Cuentame tu vida...">
			</textarea>	
		</div>
		<div class="campoForm">
		<div id="limpieza" style="clear:both;"></div> 
		
<?php 
	$this->load->view("inc/pie.inc.php")

 ?>