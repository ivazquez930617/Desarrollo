<?php
include_once "../referencias/negocio/controlador/ctrlcarga.php";
include_once "../referencias/negocio/controlador/ctrlglobal.php";

    $Carga = new CtrlCarga();
    $ControladorGlobal = new CtrlGlobal();
    $NombrePublicacion = $_POST["TxtNombrePublicacion"];
    $IdPublicacion = $_POST["IdPublicacion"];
    $MantenerNombrePublicacion = $_POST["MantenerNombrePublicacion"];

    if($NombrePublicacion == ""){
        $NombrePublicacion = str_replace(".pdf", "", $NombreArchivo);
    }else{
        $NombrePublicacion = str_replace(".pdf", "", $NombrePublicacion);
    }

    $Existe = $Carga->ValidarExistenciaPublicacion($IdPublicacion, $NombrePublicacion, "");

    if($Existe == 0){
            $Carga->ActualizarDatosArchivosCargados($IdPublicacion, $NombrePublicacion, "", "", $MantenerNombrePublicacion);
            $ControladorGlobal->EscribirLog("Actualiza nombre publicacion Cargo valor: ".$NombrePublicacion);
    }
    else
    {
        $ControladorGlobal->EscribirLog("Actualiza nombre publicacion No cargo valor: ".$NombrePublicacion);
    }

?>