<?php
include_once "../referencias/negocio/controlador/ctrlcarga.php";
include_once "../referencias/negocio/controlador/ctrlglobal.php";

/*********************************************************************
$_FILES['file']['error']

UPLOAD_ERR_OK
Valor: 0; No hay error, fichero subido con éxito.

UPLOAD_ERR_INI_SIZE
Valor: 1; El fichero subido excede la directiva upload_max_filesize de php.ini.

UPLOAD_ERR_FORM_SIZE
Valor: 2; El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML.

UPLOAD_ERR_PARTIAL
Valor: 3; El fichero fue sólo parcialmente subido.

UPLOAD_ERR_NO_FILE
Valor: 4; No se subió ningún fichero.

UPLOAD_ERR_NO_TMP_DIR
Valor: 6; Falta la carpeta temporal. Introducido en PHP 5.0.3.

UPLOAD_ERR_CANT_WRITE
Valor: 7; No se pudo escribir el fichero en el disco. Introducido en PHP 5.1.0.

UPLOAD_ERR_EXTENSION
Valor: 8; Una extensión de PHP detuvo la subida de ficheros. 
PHP no proporciona una forma de determinar la extensión que causó la parada de la subida de ficheros;
 el examen de la lista de extensiones cargadas con phpinfo() puede ayudar. Introducido en PHP 5.2.0.
*********************************************************************/

if(!empty($_FILES))
{
    $Carga = new CtrlCarga();
    $ControladorGlobal = new CtrlGlobal();

    $NombreDirectorio = "C:\\xampp7\\htdocs\\publicaciones\\repositorio\\";
    $NombreArchivo = $_FILES['file']['name'];
    $RutaCompleta = $NombreDirectorio.$NombreArchivo;
    $Existe = 0;
    
    $Existe = $Carga->ValidarExistenciaPublicacion($NombreArchivo);

    if($Existe == 0){
        if(move_uploaded_file($_FILES['file']['tmp_name'], $RutaCompleta))
        {
            $ControladorGlobal->EscribirLog("Cargo valor: ".$_FILES['file']['error']." ".$RutaCompleta);
            $Carga->InsertarDatosArchivosCargados($NombreArchivo, $NombreArchivo, str_replace("\\", "/", $NombreDirectorio));
        }
        else
        {
            $ControladorGlobal->EscribirLog("No cargo valor: ".$_FILES['file']['error']." ".$RutaCompleta);
        }
    }
    else
    {
        header("HTTP/1.0 404 Not Found", true, 404);
    }
}
?>