<?php 
$this->load->view("inc/cabecera.inc.php")

 ?>

<h2> Regístrate (falta funcionalidad aún)</h2>
<h4> Hazte de oro vendiendo y subastando los productos que ya no quieres en nuestra web. 
	Para ello solo tienes que registrarte aquí. Es muy sencillo, ¡adelante! </h4>

<form action="registrar" method="POST">
	<fieldset>
		<div class="campoForm">
			<label for="nick">Nombre usuario*: </label> <br>
			<input type="text" name="nick" placeholder="Introduce tu nombre de usuario...">		
		</div>
		<div class="campoForm">
			<table>
        		<tr>
		            <td><label for="pass">Contraseña*: </label></td> 	                          
	            	<td> </td>
            		<td><label for="pass2">Repite tu contraseña*: </label> </td>                   
            		<td> </td>
            		<td><label id="aviso_pass" style="color: red"> </label> </td>                   
        		</tr>
        		<tr>
		            <td><input type="password" id="pass1" name="pass" placeholder="Introduce tu contraseña..."> </td>   
					<td> </td>
            		<td><input type="password" id="pass2" name="pass2" placeholder="Repite tu contraseña..." onBlur="comprobarPassword();"></td>              
        		</tr>
        	</table>	
		</div>
		<div class="campoForm">
			<table>
        		<tr>
		            <td><label for="email">Correo*: </label></td> 	                          
	            	<td> </td>
            		<td><label for="pass">Repite tu correo*: </label></td>
            		<td> </td>
            		<td><label id="aviso_mail" style="color: red"> </label> </td>                   
        		</tr>
        		<tr>
		            <td><input type="email" id="email1" name="email" placeholder="Introduce tu correo..."></td>   
					<td> </td>
            		<td><input type="email" id="email2" name="email" placeholder="Repite tu correo..." onBlur="comprobarEmail();"></td>              
        		</tr>
        	</table>	
		</div>
	</fieldset>

	<br>

	<fieldset>
		<div class="campoForm">
			<table>
        		<tr>
		            <td><label for="nombre">Nombre real: </label> </td> 	                          
	            	<td> </td>
            		<td><label for="pass">Apellido real: </label></td>                   
        		</tr>
        		<tr>
		            <td><input type="text" name="nombre" placeholder="Introduce tu nombre..."></td>   
					<td> </td>
            		<td><input type="text" name="nombre" placeholder="Introduce tu apellido..."></td>              
        		</tr>
        	</table>	
		</div>
		<div class="campoForm">
			<table>
        		<tr>
		            <td><label for="fecha">Fecha de nacimiento*: </label></td> 	                          
	            	<td> </td>
            		<td><label for="genero">Género: </label></td> 
            		<td> </td>
            		<td><label id="aviso_date" style="color: red"> </label> </td>                  
        		</tr>
        		<tr>
		            <td><input type="date" name="fecha" placeholder="DD/MM/YYYY" onBlur="comprobarFecha();"></td>   
					<td> </td>
            		<td><input type="radio" name="genero" value="H" checked> Hombre
						<input type="radio" name="genero" value="M"> Mujer
					</td>              
        		</tr>
        	</table>			
		</div>
		<div class="campoForm">
			<label for="nacionalidad">Nacionalidad: </label>
			<select name="nacionalidad" placeholder="seleccione una nacionalidad">
				<!--<option value="-1" >seleccione una provincia...</option>-->
				<option value="01">Español/a</option>
				<option value="02">Francés/a</option>
				<option value="03">Portugués/a</option>
				<option value="04">De más lejos</option>
			</select>
		</div>
	</fieldset>

	<br>

	<fieldset>
		<div class="campoForm">
			<label for="direccion">Dirección: </label> <br> 
			<input type="text" name="direccion" placeholder="Introduce tu dirección..."> <br>
			<table>
        		<tr>
		            <td><label for="provincia">Provincia: </label> </td> 	                          
	            	<td> </td>
            		<td><label for="localidad">Localidad: </label> </td>                   
        		</tr>
        		<tr>
		            <td><input type="text" name="provincia" placeholder="Introduce tu provincia..."></td>   
					<td> </td>
            		<td><input type="text" name="localidad" placeholder="Introduce tu localidad..."></td>              
        		</tr>
        	</table>	
		</div>
	</fieldset>

	<br>

	<fieldset>
		<div class="campoForm">		
			<input type="checkbox" name="aceptar"> Acepto los <a href="">términos y condiciones</a>, a pesar de que no me los he leido* 
			<label id="aviso_checkbox" style="color: red"> </label>
			<br>
			<input type="checkbox" name="aceptar"> Quiero mantenerme informado de todas las novedades futuras
		</div>
	</fieldset>

	<p>* Campos obligatorios</p>

	<div class="campoForm">
		<input type="submit" value="Registrar">
	</div>

</form>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>