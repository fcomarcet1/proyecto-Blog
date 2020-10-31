<?php

//formatea entrada
//remove white spaces and escape html to prevent xss
function validate($input) {
	
	
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

/*
  Función que comprueba si se ha añadido correctamente el codigo postal
  @param string $cadena
  @return boolean
 */

function validaPostal($cadena) {
    //Comrpobamos que realmente se ha añadido el formato correcto
    if (preg_match('/^[0-9]{5}$/i', $cadena))
    //La instruccion se cumple
        return true;
    else
    //Contiene caracteres no validos
        return false;
}

//validar URL http://www.test.es sin http:// ->false

function check_url($website) {

    global $website;

    if (filter_var($website, FILTER_VALIDATE_URL)) {

        echo 'URL OK';
        return true;
    } else {

        $websiteError = 'No es una URL valida.Ej http://www.test.es';
        return $websiteError;
    }
}

