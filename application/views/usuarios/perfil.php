<?php $this->load->view("inc/cabecera.inc.php") ?>
<div id="lateral"style="width:180px; border-style:solid; border-width:1px; margin:3px; float:left; margin:10px; padding:3px;">
	<div id="imag" style="width:150px; height:150px; border-style:solid; border-width:1px; margin:3px; padding:3px;"> imagen</div>
	<h3 id="user"> <?php echo $tupla->userName ?> </h4>
	<?php echo anchor('tiendas/tienda','Ver Tienda') ?>
	<p id = "email">Email: <?php echo $tupla->email ?></p>
	<p id = "votos">Votos Positivos: <?php echo 'falta implementar' ?></p>
</div>

<div class="campoForm">
			<label for="desc">Recomienda a <?php echo $tupla->userName ?>:  </label> <br>
			<textarea name="desc" cols="40" rows="5" placeholder="¡Comenta tu voto!">
			</textarea>	
			<button id="positivo">Positivo</button>
			<button id="positivo">Negativo</button>
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