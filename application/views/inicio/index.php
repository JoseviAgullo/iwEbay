<?php 
$this->load->view("inc/cabecera.inc.php")

 ?>

 <div>
	<nav id="MenuNav" align="left" style="border-style:solid; border-width:1px;">
		<ul>
			<li> <?php echo anchor('usuarios/login', 'Categoría 1');?> </li>
			<li> <?php echo anchor('usuarios/login', 'Categoría 2');?> </li>
			<li> <?php echo anchor('usuarios/login', 'Categoría 3');?> </li>
			<li> <?php echo anchor('usuarios/login', 'Categoría 4');?> </li>
			<li> <?php echo anchor('usuarios/login', 'Categoría 5');?> </li>
		</ul>
	</nav>

	<br>
	
	<div id="Destacados"  style="border-style:solid; border-width:1px;">
		<h2>Productos Destacados</h2>
		<div class="item_destacado" style="border-style:solid; border-width:1px; margin:3px; width:150px">
			imagen aquí
			<p>Producto 1</p>
		</div>
		<div class="item_destacado" style="border-style:solid; border-width:1px; margin:3px; width:150px">
			imagen aquí
			<p>Producto 2</p>
		</div>
		<div class="item_destacado" style="border-style:solid; border-width:1px; margin:3px; width:150px">
			imagen aquí
			<p>Producto 3</p>
		</div>
	</div>

</div>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>