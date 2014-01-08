<?php $this->load->view("inc/cabecera.inc.php") ?>


<?php echo anchor('admin/productos', 'Productos | '); ?>
    <?php echo anchor('admin/Subastas', 'Subastas | '); ?>
    <?php echo anchor('admin/Tiendas', 'Tiendas | '); ?>
    <?php echo anchor('admin/Usuarios', 'Usuarios | '); ?>
	<?php echo anchor('admin/Categorias', 'Categorias | '); ?>
    <?php echo anchor('admin/Votos', 'Votos'); ?>

<?php
	$this->load->view("inc/pie.inc.php")
 ?>