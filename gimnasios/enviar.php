<?php
include_once("compartida/mis_funciones_form.php");
include_once("compartida/mis_arreglos_form.php");

//-----------------------------------------------------------------------------
//INICIALIZACIÓN DE VARIABLES QUE CONTENDRÁN LOS VALORES RECIBIDOS POR POST
//COINCIDEN con el campo NAME del formulario
//-----------------------------------------------------------------------------

$apellido = "";
$nombre = "";
$mail = "";
$calle = "";
$numero = 0;
$cp = 0;
$fecha = "";
$tipo = 0;
$sexo = 0;
$idioma = "";
$observaciones="";

//-----------------------------------------------------------------------------
//RECEPCIÓN Y LIMPIEZA DE DATOS
//-----------------------------------------------------------------------------

if(!empty($_POST["apellido"])){
	$apellido = (string)limpiarValor($_POST["apellido"]);
}

if(!empty($_POST["nombre"])){
	$nombre = (string)limpiarValor($_POST["nombre"]);
}

if(isset($_POST["mail"])){
	$mail = (string)limpiarValor($_POST["mail"]);

}

if(!empty($_POST["calle"])){
	$calle = (string)limpiarValor($_POST["calle"]);
}

if(!empty($_POST["numero"])){
	$numero = (int)limpiarValor($_POST["numero"]);
}

if(isset($_POST["cp"])){
	$cp = (int)limpiarValor($_POST["cp"]);
}

if(isset($_POST["fecha"])){
	$fecha = limpiarValor($_POST["fecha"]);
}

if(isset($_POST["tipo"])){
	$tipo = (int)limpiarValor($_POST["tipo"]);
}

if(isset($_POST["sexo"])){
	$sexo = (string)limpiarValor($_POST["sexo"]);
}

if(isset($_POST["idioma"])){
	$idioma = $_POST["idioma"];
}

if(isset($_POST["observaciones"])){
	$observaciones = (string)limpiarValor($_POST["observaciones"]);
}

//Limpieza de los valores recibidos en el array $idioma, que contiene los value de los checkbox marcados en el formulario 
//sino se eligió ningún check en el form $idioma no es un array, es una variable vacía ""
if($idioma !=""){	
	$check="";//esta variable guardará los value recibidos en el array $idioma
	foreach ($idioma as $key => $value) {
		$valor_check = (string)limpiarValor($value);		
		$check.= "$valor_check|";//acumulo todo los value recibidos, es decir todos los values de los checkbox seleccionados en el form
	}
	$check = substr($check, 0, -1);	//esta funciópn le quita el ultimo caracter al contenido de $check, una |
}
else{//en el caso de que no se hayan elegido checks en el form
	$check=0; //significa que no se ha elegido ningú check en el formulario
}

//-----------------------------------------------------------------------------
//VALIDACIÓN DE DATOS DE DATOS
//-----------------------------------------------------------------------------

$hay_error=false;
$error="";

if($apellido == ""){
	$error.="10A - Complete formulario - falta apellido <br />";	
	$hay_error=true;
}

if($nombre == ""){
	$error.="20A - Complete formulario - falta nombre <br />";	
	$hay_error=true;
}

if($mail == ""){
	$error.="30A - Complete formulario - falta mail <br />";	
	$hay_error=true;
}

if($tipo == 0){
	$error.="40A - Complete formulario  - falta tipo documento <br />";	
	$hay_error=true;
}

//-----------------------------------------------------------------------------
//RECEPCIÓN Y LIMPIEZA DE DATOS de formulario 2
//-----------------------------------------------------------------------------

if(!empty($_POST["calle"])){
	$calle = (string)limpiarValor($_POST["calle"]);
}

if(!empty($_POST["numero"])){
	$numero = (int)limpiarValor($_POST["numero"]);
}

if(isset($_POST["cp"])){
	$cp = (int)limpiarValor($_POST["cp"]);
}

//----------------------------------------------------------------------------------
//VALIDACIÓN DE DATOS RECIBIDOS según la validación que se hizo del lado del cliente
//----------------------------------------------------------------------------------

$hay_error=false;
$error="";

//Validación de un campo texto
//strlen() cuenta la cantidad de caracteres de una cadena
if($calle == "" || !is_string($calle) || strlen($calle)<4 || strlen($calle)>60){
	$error.="50A - Complete formulario - falta calle <br />";	
	$hay_error=true;
}

if($numero == "" || !is_int($numero)){
	$error.="60A - Complete formulario - falta numero <br />";	
	$hay_error=true;
}


//-----------------------------------------------------------------------------
//DE ACUERDO AL RESULTADO DE LA VALIDACIÓN 
//SE DEFINE COMO CONTINUA LA EJECUCIÓN DEL PROGRAMA
//-----------------------------------------------------------------------------

//if(!$hay_error){//No hay errores de validación
//
//	//Creo las variables de session con los datos que recibí del formulario 2
//	$_SESSION["calle"]=$calle;
//	$_SESSION["numero"]=$numero;
//	$_SESSION["cp"]=$cp;
//	header("Location: paginas/ok.php");	
//}
//else{//Hay errores en la validación	
//
//	//$error es una variable acumulativa que se genera durante el proceso de validación de datos 
	//y guarda todos los mensajes de error que se hayan encontrado durante la validación
	//la codifico con base64_encode() entes de enviarla por GET para que no se vea en la URL claramente
//	$error=base64_encode($error);
//	header("Location: paginas/nook.php?e=$error");		
//}
//-----------------------------------------------------------------------------
//DE ACUERDO AL RESULTADO DE LA VALIDACIÓN 
//SE DEFINE COMO CONTINUA LA EJECUCIÓN DEL PROGRAMA
//-----------------------------------------------------------------------------

if(!$hay_error){//No hay errores de validación

	//si hay idiomas elegidos en el form preparo los nombres de los idiomas para mostrar
	//$check es 0 si no hay idiomas elegidos
	//Si hay idiomas elegidos, $check guarda los indices de los idiomas de esta manera: 1|2|3
	if($check !=0 ){
		$arr_indices_idioma=explode("|",$check);//genero el arreglo $arr_indices_idioma con los valores almacendos en $check
		$mostrar_idiomas="";//inicializo la variable que contendrá los idiomas
		foreach ($arr_indices_idioma as $key => $value) {
			$mostrar_idiomas.= $arr_idioma[$value]." - ";		
		}
	}
	else{//no se eligieron idiomas en el form
		$mostrar_idiomas="No selecciono ninguno";
	}

	echo "
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<link rel='stylesheet' type='text/css' href='css/css_mensajes_form.css'>
			</head>
			<body>

				<section>

					<header>
						GRACIAS POR SU COLABORACIÓN
					</header>

					<main>
						<p class='titulo'>Recibimos correctamente la siguiente información:</p>
						<p class='pok'><span class='titulo2'>Nombre:</span> $nombre</p>
						<p class='pok'><span class='titulo2'>Apellido:</span> $apellido</p>			
						<p class='pok'><span class='titulo2'>Email:</span> $mail</p>
						<p class='pok'><span class='titulo2'>Calle:</span> $calle</p>
						<p class='pok'><span class='titulo2'>Numero:</span> $numero</p>
						<p class='pok'><span class='titulo2'>Codigo Postal:</span> $cp</p>
						<p class='pok'><span class='titulo2'>Fecha:</span> $fecha</p>	
						<p class='pok'><span class='titulo2'>Tipo:</span> $arr_tipo_dni[$tipo]</p>	
						<p class='pok'><span class='titulo2'>Sexo:</span> $arr_sexo[$sexo]</p>
						<p class='pok'><span class='titulo2'>Idiomas:</span> $mostrar_idiomas</p>
						<p class='pok'><span class='titulo2'>Observaciones:</span> $observaciones</p>
						<p>GRACIAS POR SU COLABORACIÓN</p>
					</main>

					<footer>
						© 2021 - Webpage Eduardo - Casa Matriz: Calle Italia N° 450 (8000) Bahia Blanca, Buenos Aires, Argentina 
					</footer>

				</section>

			</body>
			</html>
	";
}
else{//Hay errores en la validación	
	echo "
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<link rel='stylesheet' type='text/css' href='css/css_mensajes_form.css'>	
			</head>
			<body>

				<section>

					<header class='nook'>
						NO FUE POSIBLE COMPLETAR LA OPERACIÓN
					</header>

					<main>
						<p class='titulo'>Ooops! No recibimos correctamente los datos que nos envió.</p>
						<p class='errores'>$error</p>
						<p>Por favor inténtelo nuevamente.</p>
						<p>Disculpe las molestias.</p>
						<a href='index.php'>Volver al formulario</a>
					</main>

					<footer>
						© 2021 - Webpage Eduardo - Casa Matriz: Calle Italia N° 450 (8000) Bahia Blanca, Buenos Aires, Argentina  
					</footer>

				</section>

			</body>
			</html>
	";
	exit();
}

?>