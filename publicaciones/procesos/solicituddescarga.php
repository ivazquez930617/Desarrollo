<?php
include_once "../referencias/negocio/controlador/ctrlcarga.php";
include_once "../referencias/negocio/controlador/ctrlglobal.php";
include_once "../referencias/negocio/controlador/ctrllistado.php";
include_once "../referencias/html/html.php";

$Carga = new CtrlCarga();
$ControladorGlobal = new CtrlGlobal();
$ControladorListado = new CtrlListado();
$Html = new Html();

$IdPublicacion = $_POST["IdPublicacion"];
$TxtNombreCompleto = $_POST["TxtNombreCompleto"];
$TxtInstitucion = $_POST["TxtInstitucion"];
$CbActividad = $_POST["CbActividad"];
$TxtAreaCarrera = $_POST["TxtAreaCarrera"];
$TxtCorreo = $_POST["TxtCorreo"];

$URLDescarga = $Carga->InsertarSolicitudDescarga($IdPublicacion, $TxtNombreCompleto, $TxtInstitucion, $CbActividad, $TxtAreaCarrera, $TxtCorreo);
$ControladorGlobal->EscribirLog("Se descarga la publicación con id: ".$IdPublicacion);

echo "<div id=\"titulo-carga\"><h5>Descarga de publicaciones</h5></div>
    <div id=\"titulo-descripcion\"><h6>¡Su link de descarga esta listo!</h6></div>
    <div id=\"contenedor-archivo-descarga\">.$URLDescarga.</div>";

?>