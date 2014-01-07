<?php 
$this->load->view("inc/cabecera.inc.php");
date_default_timezone_set('UTC');
 ?>

<h2> Regístrate (falta funcionalidad aún)</h2>
<h4> Hazte de oro vendiendo y subastando los productos que ya no quieres en nuestra web. 
	Para ello solo tienes que registrarte aquí. Es muy sencillo, ¡adelante! </h4>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    jQuery(function ($) {
        $.datepicker.regional['es'] = {
            yearRange: '-110:-18',
            defaultDate: '-18y',
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié;', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
    });
    $(function () {
        $("#datepicker").datepicker({
            firstDay: 1
        });
    });
</script>

<?php
$error = $this->session->flashdata('error');
if($error){
    echo('<hr> <p style="color:red">' . $error . '</p> <hr>');
}
?>

<?php echo form_open_multipart('usuarios/do_modificar/'.$usuario->id) ?>
	<fieldset>

        <div class="campoForm">
            <label for="descripcion">Inserte una imagen de perfil: </label> <br>
            <input type="file" name="userfile" size="20" />
            <br /><br />
        </div>
        
		<div class="campoForm">
			<table>
        		<tr>
		            <td><label for="pass">Nombre de usuario*: </label></td>
	            	<td> </td>
            		<td><label for="pass2">Correo electrónico*: </label> </td>
            		<td> </td>
        		</tr>
        		<tr>
		            <td><input type="text" id="username" name="username" placeholder="Introduce tu nombre de usuario" value="<?php echo $usuario->userName ?>"> </td>
					<td> </td>
            		<td><input type="text" id="email" name="email" placeholder="Introduce tu email" value="<?php echo $usuario->email ?>"></td>
        		</tr>
        	</table>	
		</div>
		<div class="campoForm">
			<table>
        		<tr>
		            <td><label for="pass1">Nueva contraseña*: </label></td>
	            	<td> </td>
            		<td><label for="pass2">Repetir contraseña*: </label></td>
            		<td> </td>
        		</tr>
        		<tr>
		            <td><input type="password" name="pass1" placeholder="Introducte tu nueva contraseña"></td>
					<td> </td>
            		<td><input type="password" name="pass2" placeholder="Vuelve a introducir tu nueva contraseña"></td>
        		</tr>
        	</table>	
		</div>
	</fieldset>

	<br>

	<fieldset>
		<div class="campoForm">
			<label for="direccion">Dirección: </label> <br> 
			<input type="text" name="direccion" placeholder="Introduce tu dirección..." value="<?php echo $usuario->direccion ?>"> <br>
			<table>
        		<tr>
		            <td><label for="telefono">Telefono: </label> </td>
	            	<td> </td>
            		<td><label for="f_nacimiento">Fecha de nacimiento: </label> </td>
        		</tr>
        		<tr>
		            <td><input type="text" name="telefono" placeholder="Introducte tu teléfono" value="<?php echo $usuario->telefono ?>"></td>
					<td> </td>
            		<td><input id="datepicker" type="date" name="f_nacimiento" placeholder="DD-MM-AAAA" value="<?php echo date('d-m-Y', strtotime($usuario->fecha_nacimiento )) ?>"></td>
        		</tr>
        	</table>	
		</div>
	</fieldset>

    <br>

    <fieldset>
        <div class="campoForm">
            <label for="password">Contraseña*:</label><br>
            <input type="password" placeholder="Introduce tu contraseña para confirmar cambios" name="password">
        </div>
    </fieldset>

    <p>* Campos obligatorios</p>

	<div class="campoForm">
		<input type="submit" value="Modificar Información">
        <?php echo anchor('usuarios/borrar/'.$usuario->id , 'Borrar', array('onclick'=>"return confirm('¿Estás seguro? La vas a liar fijo...')")); ?>
	</div>

</form>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>