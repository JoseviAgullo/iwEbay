<?php 
$this->load->view("inc/cabecera.inc.php"); 
$this->load->helper('form');
$this->load->helper('file');
$usuario = $this->session->userdata('usuario')
?>
<div id="lateral"style="width:180px; border-style:solid; border-width:1px; margin:3px; float:left; margin:10px; padding:3px;">
	
	
	<div id="imag" style="width:150px; height:150px; border-style:solid; border-width:1px; margin:3px; padding:3px;"> <?php echo $img_perfil ?></div>
	<h3 id="user"> <?php echo $tupla->userName ?> </h3>
	<?php echo anchor('tiendas/tienda/'. $tienda,'Ver Tienda') ?>
	<p id = "email">Email: <?php echo $tupla->email ?></p>
	<p id = "votos">Votos Positivos: <?php echo $cantidad_positivos . ' de '. $cantidad_total ?></p>
    <?php
        if($usuario != '' && $usuario['id'] == $tupla->id) {
            echo anchor('usuarios/perfil/' . $tupla->id .'/modificar', 'Modificar perfil');
        }
    ?>

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
			if($usuario != '' && $usuario['id'] != $tupla->id)
        	{
                echo('<label for="desc">Recomienda a '. $tupla->userName . ':  </label> <br>
                <textarea name="desc" cols="40" rows="5" placeholder="¡Comenta tu voto!">
                </textarea><br>');

                echo('<button id="env_voto" name="env_voto" value="posi">Positivo</button>');
                echo('<button id="env_voto" name="env_voto" value="nega">Negativo</button>');
                echo form_close();
            } else {

            }
        ?>
		</div>
		<div class="campoForm">
			<fieldset>
			<h3>Subastas</h3>
			<?php echo $ventas;?>
			<fieldset>
		</div>
		<div class="campoForm">
		<div id="limpieza" style="clear:both;"></div> 
		
<?php 
	$this->load->view("inc/pie.inc.php")

 ?>