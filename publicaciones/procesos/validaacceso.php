<?php
include_once "../referencias/negocio/controlador/ctrlcarga.php";
include_once "../referencias/negocio/controlador/ctrlglobal.php";
include_once "../referencias/negocio/controlador/ctrllogin.php";
include_once "../referencias/html/html.php";

$Carga = new CtrlCarga();
$ControladorGlobal = new CtrlGlobal();
$ControladorLogin = new CtrlLogin();
$Html = new Html();

$NombreUsuario = $_POST["NombreUsuario"];
$Password = $_POST["Password"];
$RespuestaJson = "";

$ControladorGlobal->EscribirLog("Intento de acceso al sistema: ".$NombreUsuario); 
$RespuestaJson = $ControladorLogin->ValidarAcceso($NombreUsuario, $Password);

$obj = json_decode($RespuestaJson);

if($obj->{"IdMensaje"} == 1){
    session_start(); 
    $_SESSION["NombreUsuario"] =  $NombreUsuario;
}

echo $RespuestaJson;

?>