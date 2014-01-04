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
                if($usuario = $this->session->userdata('usuario'))
                {
                    echo anchor('usuarios/perfil/'.$usuario['nick'], $usuario['nick']);
                     echo ' | ';
                     echo anchor('usuarios/do_logout', 'Logout');

                } else {
                    echo anchor('usuarios/login', 'Login');
                    echo ' | ';
                    echo anchor('usuarios/registro', 'Registro');
                }
            ?>
		</span>
		<h1><?php echo anchor('inicio', $tituloBody); ?></h1>

	
	<div id="body">