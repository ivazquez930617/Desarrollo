<?php
include_once "../referencias/negocio/controlador/ctrlcarga.php";
include_once "../referencias/negocio/controlador/ctrlglobal.php";
include_once "../referencias/negocio/controlador/ctrllistado.php";
include_once "../referencias/html/html.php";

$Carga = new CtrlCarga();
$ControladorGlobal = new CtrlGlobal();
$ControladorListado = new CtrlListado();
$Html = new Html();

$TxtBuscar = $_POST["TxtBuscar"];

$Html->Table("TabListadoPublicaciones", $ControladorListado->BuscarPublicaciones($TxtBuscar), "class=\"table\"");

?>