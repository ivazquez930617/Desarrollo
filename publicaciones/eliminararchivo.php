<?php
include_once "referencias/negocio/controlador/ctrlcarga.php";
include_once "referencias/negocio/controlador/ctrlglobal.php";
include_once "referencias/negocio/controlador/ctrllistado.php";
include_once "referencias\html\html.php";

$Carga = new CtrlCarga();
$ControladorGlobal = new CtrlGlobal();
$ControladorListado = new CtrlListado();
$Html = new Html();

$IdPublicacion = $_POST["IdPublicacion"];
$RutaArchivo = $_POST["RutaArchivo"];

$Carga->EliminarPublicacion($IdPublicacion);
unlink($RutaArchivo);

$ControladorGlobal->EscribirLog("Se elimina publicación: ".$IdPublicacion);

$Html->Table("TabListadoPublicaciones", $ControladorListado->ListarPublicaciones(), "class=\"table\"");

?>