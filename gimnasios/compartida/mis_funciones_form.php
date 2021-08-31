<?php
include_once("mis_arreglos_form.php");

//********************************************************************************************************
//función para "limpiar valores recibidos por GET o POST"
function limpiarValor($data) {

	// Quitamos los espacios, tanto en el principio como en el final
	$data = trim($data);
	// Quitamos las barras invertidas \
	$data = stripslashes($data);
	// Convierte caracteres especiales a HTMLpor ejemplo "<" a "&lt;", sirve para prevenir ataques de inyección de código
	$data = htmlspecialchars($data);

	return $data;
}

//********************************************************************************************************
//esta función devuelve el código HTML de una lista desplegable 
//utiliza el arreglo de tipos de documentos para cargas los valores de la lista
function crear_select_tipo_dni(){

	global $arr_tipo_dni;
	$html="<select name='tipo' class='dato' required><span class='requerido'>(*)</span>
			<option value=''>Elija tipo...</option>	";
	foreach ($arr_tipo_dni as $key => $value) {
		$html.="<option value='$key'>$value</option>";		
	}
	$html.="</select>";
	return $html;

}//fin crear_select_tipo_dni


//*********************************************************************************************************
//Esta función devuelve el código html de un grupo de radiobuttons
//utiliza el arreglo de sexos para definir los valores
function armar_radio_sexo(){

	global $arr_sexo;
	$html="";
	foreach ($arr_sexo as $key => $value){
		if($key == 1){
			$checked="checked";
		}
		else{
			$checked="";
		}
		$html.="<input type='radio' name='sexo'  value='$key' class='dato' $checked />$value";		
	}//fin foreach
	return $html;

}//fin armar_radio_sexo


//*********************************************************************************************************
//Esta función devuelve el código html de un grupo de checkbox
//utiliza el arreglo de idiomas para definir los valores
function armar_checkbox_idioma(){

	global $arr_idioma;
	$html="";
	foreach ($arr_idioma as $key => $value){		
		$html.="<input type='checkbox' name='idioma[]'  value='$key' class='dato' />$value";		
	}//fin foreach
	return $html;

}//fin armar_checkbox_idioma

?>