<?php
include_once("compartida/mis_funciones_form.php");
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<title>Formulario2</title>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="robots" content="">

	<link rel="stylesheet" type="text/css" href="css/css_index_form.css">
	
</head>
<body>	

	<form name="formulario" method="post" action="enviar.php" class="miform">		

		<h2>Formulario de inscripción</h2>

		<div>
			<label for="">Apellido</label>
			<input type="text" name="apellido" class="dato" required /><span class="requerido">(*)</span>
		</div>

		<div>
			<label for="">Nombre</label>
			<input type="text" name="nombre" class="dato" required  /><span class="requerido">(*)</span>
		</div>

		<div>
			<label for="">Email</label>
			<input type="email" name="mail" class="dato" required />
		</div>		

        <div>
			<label for="">Calle</label>
			<input type="text" name="calle" class="dato" required minlength="4" maxlength="60" /><span class="requerido">(*)</span>
		</div>

		<div>
			<label for="">Numero</label>
			<input type="number" name="numero" class="dato" required /><span class="requerido">(*)</span>
		</div>

		<div>
			<label for="">Codigo Postal</label>
			<input type="number" name="cp" class="dato" />
		</div>	
		<div>
			<label for="">Nacimiento</label>
			<input type="date" name="fecha" class="dato" />
		</div>		
		
		<div>
			<label for="">Tipo DNI</label>
			<?php
				$select_dni = crear_select_tipo_dni();
				echo $select_dni;
			?>
		</div>
				
		<div>
			<label for="">Sexo</label>
			<?php
				$radio_sexo = armar_radio_sexo();
				echo $radio_sexo;
			?>
		</div>			
		
		<div>
			<label for="">Idiomas</label>
			<?php
				$check_idioma = armar_checkbox_idioma();
				echo $check_idioma;
			?>			
		</div>	
	
		<div>
			<label for="">Observaciones</label>
			<textarea cols="50" rows="4" name="observaciones"></textarea>
		</div>		

		<div class="botones">
			<input type="submit" name="" value="Enviar">
			<input type="reset" name="" value="Restablecer">	
		</div>

		<div class="pie">
			<span class="requerido">(*)</span> Campo obligatorio
		</div>

	</form>

</body>
</html>