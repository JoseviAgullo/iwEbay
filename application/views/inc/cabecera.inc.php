<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $tituloHead ?></title>		
</head>
<body>

<div id="container">
	
		<span style="float: right">
            <?php
                echo anchor('usuarios/login', 'Login');
                echo ' | ';
                echo anchor('usuarios/registro', 'Registro');
            ?>
		</span>
		<h1><?php echo $tituloBody ?></h1>

	
	<div id="body">