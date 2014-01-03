<style type="text/css">
/* Menú Vertical
----------------------------------------------- */
#menuvert ul {
list-style-type: none;
margin: 0px;
padding: 0px;
width: 200px; /* ancho del menú */
font-size: 11pt;
}
#menuvert ul li {
background-color: #B0CBDD; /* color de fondo del menú */
padding: 0px;
}
#menuvert ul li a {
color: #000; /* color de las letras */
text-decoration: none;
display: block;
padding: 10px 10px 10px 20px;
}
#menuvert ul li:hover {
background: #336699; /* color del botón al pasar el cursor */
border-left: 10px solid #000066; /* color del rectángulo junto al título */
color: #FFFFFF; /* color de las letras al pasar el cursor */
}
</style>


 <div>
	<div id="menuvert" float="left" style="float:left">
		<ul>
			<?php 			
				foreach ($categorias as $fila){
					echo anchor('usuarios/login', '<li>'.$fila->categoria.'</li>');
				}
			?>
		</ul>

	</div>

	
		