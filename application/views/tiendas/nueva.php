<?php 
$this->load->view("inc/cabecera.inc.php")

 ?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    jQuery(function ($) {
        $.datepicker.regional['es'] = {
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
            dateFormat: 'dd/mm/yy',
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

<h2> ¡Crea tu propia tienda!</h2>
<h4> Consigue que la gente adquiera tus productos de forma fácil y sencilla creando tu propia tienda en un instante.</h4>

<?php
$error = $this->session->flashdata('error');
if($error){
    echo('<hr> <p style="color:red">' . $error . '</p> <hr>');
}
?>
<form action="crear" method="POST">
	<fieldset>
		<div class="campoForm">
			<label for="nombre">Nombre de la tienda: *  </label> <br>
			<input type="text" name="nombre"placeholder="Nombre de la tienda">
		</div>
		<div class="campoForm">
			<label for="descripcion">Descripcion: * </label> <br>
			<textarea name="descripcion" placeholder="Una breve descripción de los que habrá en tu tienda y por qué la gente debería comprarte a ti." rows="4" cols="50"></textarea>
		</div>
	</fieldset>
	<input type="submit" name="crear_tienda" value="Crear Tienda">
	<input type="button" name="cancelar" value="Cancelar">
</form>

<?php 
	$this->load->view("inc/pie.inc.php")

 ?>