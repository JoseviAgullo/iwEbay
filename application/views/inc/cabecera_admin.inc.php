<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="utf-8">
    	<title><?php echo 'IWeBay - Administración' ?></title>	
        <?php 
        foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
        <style type='text/css'>
        body
        {
            font-family: Arial;
            font-size: 14px;
        }
        a {
            color: blue;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover
        {
            text-decoration: underline;
        }
        </style>	
    </head>
    <body>
    <hr>

<div id="container">
	
		<span style="float: right">

            
            <?php
                if($usuario = $this->session->userdata('usuario'))
                {
                    
                    echo anchor('usuarios/perfil/'.$usuario['id'], $usuario['nick']);
                     echo ' | ';
                     echo anchor('usuarios/do_logout', 'Logout');

                } 
            ?>
		</span>
		<h1><?php echo anchor('inicio', 'IWeBay - Administración'); ?></h1>

	
	<div id="body">

    <?php echo anchor('admin/productos', 'Productos | '); ?>
    <?php echo anchor('admin/Subastas', 'Subastas | '); ?>
    <?php echo anchor('admin/Tiendas', 'Tiendas | '); ?>
    <?php echo anchor('admin/Usuarios', 'Usuarios | '); ?>
    <?php echo anchor('admin/Votos', 'Votos'); ?>