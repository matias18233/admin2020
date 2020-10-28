<?php

include 'conexion/conexion.php';
date_default_timezone_set('America/Argentina/Mendoza');

/**
 * Filtra una variable seg�n el filtro que se especifique.
 * @param type $valor variable a ser filtrada.
 * @param type $tipo_dato Tipo de filtro a utilizar. Pueden ser los siguientes valores: 0 (n�mero entero), 1 (cadena de caracteres), 2 (correo electr�nico), 3 (valor booleano).
 * @return type Retorna los datos filtrados o 'FALSE' si el filtro falla.
 */
function validar_variable($valor, $tipo_dato) {
    $valor = trim($valor);
    switch ($tipo_dato) {
        case 0://Tipo entero
            $valor = filter_var($valor, FILTER_VALIDATE_INT);
            break;
        case 1://Tipo cadena
            $valor = filter_var($valor, FILTER_SANITIZE_STRING);
            break;
        case 2://Tipo correo electr�nico
            $valor = filter_var($valor, FILTER_VALIDATE_EMAIL);
            break;
        case 3://Tipo booleano
            $valor = filter_var($valor, FILTER_VALIDATE_BOOLEAN);
            break;
    }
    return $valor;
}

/**
 * 
 * @param type $contra_user
 * @param type $contra_db
 * @return type
 */
function comparar_contrasenias($contra_user, $contra_db) {
    return password_verify($contra_user, $contra_db);
}

/**
 * 
 * @param type $valor
 * @return type
 */
function preparar_contrasenia($valor) {
    return password_hash($valor, PASSWORD_DEFAULT);
}

/**
 * 
 * @param type $tabla
 * @param type $campos
 * @param type $valores
 */
function almacenar_informacion($tabla, $campos, $valores) {
    $sentencia = "INSERT INTO " . $tabla . " (" . $campos . ") VALUES (" . $valores . ")";
    mysql_query($sentencia);
}

/**
 * 
 * @param type $tabla
 * @param type $campos
 * @param string $filtros
 * @param string $orden
 * @param type $limite
 * @return type
 */
function obtener_informacion($tabla, $campos, $filtros, $orden, $limite = "") {
    if ($filtros != "") {
        $filtros = " WHERE " . $filtros;
    }
    if ($orden != "") {
        $orden = " ORDER BY " . $orden;
    }
    $sentencia = "SELECT " . $campos . " FROM " . $tabla . $filtros . $orden . $limite;
    return mysql_query($sentencia);
}

/**
 * 
 * @return type
 */
function obtener_nombre_usuario() {
    $id = validar_variable($_COOKIE['id_usuario'], 0);
    if (!$id) {
        die();
    }
    $usuario = obtener_informacion("tb_usuario", "NOMBRES, APELLIDO", "ID='" . $id . "'", "");
    $usuario = mysql_fetch_array($usuario);
    $usuario = $usuario['NOMBRES'] . " " . $usuario['APELLIDO'];
    return @utf8_encode($usuario);
}

/**
 * 
 * @param type $tabla
 * @param type $campos_valores
 * @param string $filtro
 */
function modificar_informacion($tabla, $campos_valores, $filtro) {
    if ($filtro != "") {
        $filtro = " WHERE " . $filtro;
    }
    $sentencia = "UPDATE " . $tabla . " SET " . $campos_valores . $filtro;
    mysql_query($sentencia);
}

function enviar_email_contacto($mensaje, $email) {
    $to = "diegotassin@gmail.com";
    $subject = "Mensaje Enviado";
    $contenido = $mensaje;
    $header = "From: contacto@dardolucero.com.ar\nReply-To:".$email."\n";
    $header .= "Mime-Version: 1.0\n";
    $header .= "Content-Type: text/html; charset=utf-8";
    if (mail($to, $subject, $contenido ,$header)) {
        @mail("matias18233@gmail.com", $subject, $contenido ,$header); // TEST
        return 1;
    } else {
        return 0;
    }
}

function enviar_correo_electronico($mensaje, $email_cliente, $cliente) {
    $asunto = "Dardo Lucero | Nuevo pedido desde la web";
    $cabecera = "From: Web Dardo Lucero <diegotassin@gmail.com>" . "\r\n";
    $cabecera .= "Content-type: text/html;  charset=ISO-8859-1";
    //@mail("jplucero@dardoalucero.com.ar", $asunto, utf8_decode($mensaje), $cabecera);
    //@mail("d.tassin@dardoalucero.com.ar", $asunto, utf8_decode($mensaje), $cabecera);
    @mail("matias18233@gmail.com", $asunto, utf8_decode($mensaje), $cabecera); //Envío de prueba
    @mail("diegotassin@gmail.com", $asunto, utf8_decode($mensaje), $cabecera); //Envío de prueba
    //$emails = obtener_informacion("tb_correo", "EMAIL", "ACTIVO = 1", "");
    //while ($emai = mysql_fetch_array($emails)) {
    //    @mail($emai['EMAIL'], $asunto, utf8_decode($mensaje), $cabecera);
    //}
    if ($email_cliente <> "") {//S�lo env�a una copia al cliente si tiene cargada una direcci�n de correo electr�nico
        @mail($email_cliente, $asunto, utf8_decode($mensaje), $cabecera);
    }
    almacenar_informacion("tb_mensaje", "ID, CUERPO, FECHA_CARGA, HORA_CARGA, ID_CLIENTE", "NULL, '" . utf8_decode($mensaje) . "', '" . date("Y-m-d") . "', '" . date("H:m:s") . "', " . $cliente);
    $control = TRUE;
    return $control;
}

function enviar_email($mensaje, $email) {
    $asunto = "Dardo Lucero | Nuevo pedido desde la web";
    $cabecera = "From: Web Dardo Lucero <diegotassin@gmail.com>" . "\r\n";
    $cabecera .= "Content-type: text/html;  charset=ISO-8859-1";
    @mail($email, $asunto, utf8_decode($mensaje), $cabecera); //Envío de prueba
}

/**
 * 
 * @param type $fecha
 * @return type
 */
function girar_fecha($fecha) {
    $fecha = explode("-", $fecha);
    if (strlen($fecha[0]) == 4) {
        return $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
    } else if (strlen($fecha[0]) == 2) {
        return $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
    }
}

function obtener_permisos($usuario) {
    $permisos = obtener_informacion("tb_usuario", "PERMISOS", "NOMBRE='" . $usuario . "'", "");
    $permisos = mysql_fetch_array($permisos);
    return $permisos['PERMISOS'];
}

function revisar_permisos($usuario, $permiso) {
    $resultado = obtener_permisos($usuario);
    $resultado = explode(",", $resultado);
    $control = FALSE;
    foreach ($resultado as $fila) {
        if ($permiso == $fila) {
            $control = TRUE;
            break;
        }
    }
    return $control;
}

/**
 * 
 * @param type $tabla
 * @param type $condicion
 */
function eliminar_registro($tabla, $condicion) {
    $sentencia = "DELETE FROM " . $tabla . " WHERE " . $condicion;
    mysql_query($sentencia);
}

function controlar_campo($tabla, $campos, $id = "") {
    $control = FALSE;
    $resultado = obtener_informacion($tabla, "*", $campos, "");
    if (mysql_num_rows($resultado) > 0) {
        $resultado = mysql_fetch_array($resultado);
        if ($id != "") {//Es posible que estemos modificando información del usuario
            if ($resultado['ID'] == $id) {
                $control = TRUE;
            } else {
                $control = FALSE;
            }
        } else {
            $control = FALSE;
        }
    } else {
        $control = TRUE;
    }
    return $control;
}

/**
 * 
 * @param type $tabla
 * @param type $filtro
 * @param type $id
 * @return boolean
 */
function controlar_usuario_repetido($tabla, $filtro, $id = "") {
    $control = FALSE;
    $resultado = obtener_informacion($tabla, "ID, NOMBRE", $filtro, "");
    if (mysql_num_rows($resultado) > 0) {
        $resultado = mysql_fetch_array($resultado);
        if ($id != "") {//Es posible que estemos modificando informacion del usuario
            if ($resultado['ID'] == $id) {
                $control = TRUE;
            } else {
                $control = FALSE;
            }
        } else {
            $control = FALSE;
        }
    } else {
        $control = TRUE;
    }
    return $control;
}

function controlar_archivo($tabla, $nombre, $id = "") {
    $control = FALSE;
    $resultado = obtener_informacion($tabla, "ID, NOMBRE_ARCHIVO", "NOMBRE_ARCHIVO='" . utf8_encode($nombre) . "'", "");
    if (mysql_num_rows($resultado) > 0) {
        $resultado = mysql_fetch_array($resultado);
        if ($id != "") {//Es posible que estemos modificando información del usuario
            if ($resultado['ID'] === $id) {
                $control = TRUE;
            } else {
                $control = FALSE;
            }
        } else {
            $control = FALSE;
        }
    } else {
        $control = TRUE;
    }
    return $control;
}

/**
 * 
 */
function controlar_session_abierta() {
    $id = validar_variable($_COOKIE['id_usuario'], 0);
    if (!$id) {
        die();
    }
    $resultado = obtener_informacion("tb_usuario", "ID, NOMBRE", "(ID='" . $id . "') AND (ACTIVO = 1)", "");
    if (mysql_num_rows($resultado) > 0) {
        $resultado = mysql_fetch_array($resultado);
        if ($resultado['ID'] == $id) {
            $GLOBALS['nombre_usuario'] = $resultado['NOMBRE'];
        } else {
            die();
        }
    } else {
        die();
    }
}

/**
 * 
 * @param type $usuario
 * @param type $permiso
 * @return boolean
 */
function controlar_permisos($usuario, $permiso) {
    $usuario = validar_variable($usuario, 0);
    if (!$usuario) {
        die();
    } else {
        $permiso = validar_variable($permiso, 0);
        if (!$permiso) {
            die();
        } else {
            $control = obtener_informacion("tb_rel_perm", "ID_PERMISO", "(ID_USUARIO='" . $usuario . "') AND (ID_PERMISO='" . $permiso . "')", "");
            if (mysql_num_rows($control) > 0) {
                return TRUE;
            } else if (mysql_num_rows($control) == 0) {
                return FALSE;
            }
        }
    }
}

function obtener_carrito_compra() {
    $resultado = obtener_informacion("tb_carrito_compra", "SUM(CANTIDAD) as SUMA", "(ID_USUARIO = " . $_COOKIE['id_usuario'] . ")", "");
    $resultado = mysql_fetch_array($resultado);
    $resultado = $resultado['SUMA'];
    if ($resultado == 1) {
        $respuesta = "1 art&iacute;culo";
    } else if ($resultado > 100) {
        $resultado = "+100 art&iacute;culos";
    } else if (($resultado <= 100) && ($resultado > 1)) {
        $resultado = $resultado . " art&iacute;culos";
    } else {
        $resultado = "0 art&iacute;culos";
    }
    return $resultado;
}

function filtrar_archivos_extranios($nombre, $ubicacion, $tipo) {
    $fileName = $nombre;
    $tmpName = $ubicacion;
    $exito = FALSE;
    if (is_uploaded_file($tmpName)) {
        $whitelist = array('jpg', 'png'); // Allowed file extensions
        $backlist = array('php', 'php3', 'php4', 'phtml', 'exe'); // Restrict file extensions
        $exito = TRUE;
        $tmparr = explode('.', $fileName);
        if (!in_array(end($tmparr), $whitelist)) {
            $exito = FALSE;
        }
        if (in_array(end($tmparr), $backlist)) {
            $exito = FALSE;
        }
        $file_size = @filesize($tmpName);
        if (!$file_size || $file_size > 9000000) {
            $exito = FALSE;
        }
    }
    return $exito;
}

?>
