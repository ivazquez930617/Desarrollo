<?php
include_once "../referencias/basedatos/mysql.php";

class CtrlCarga
{
    var $Mysqli;
    var $Rawdata;

    public function __construct()
    {
	    $this->Mysqli = new Mysql();
	    $this->Rawdata = array();
    }

    public function InsertarDatosArchivosCargados($nombrePub, $nombreArch, $rutaRepo)
    {
    	$this->Mysqli->ExecuteDataSetArrayFull('uspAgregarPublicacion', $nombrePub, $nombreArch, $rutaRepo);
    }

    public function EliminarPublicacion($IdPublicacion)
    {
        $this->Mysqli->ExecuteDataSetArrayFull('uspEliminarPublicacion', $IdPublicacion);
    }

    public function ActualizarDatosArchivosCargados($IdPublicacion, $nombrePub, $nombreArch, $rutaRepo, $Operacion)
    {
        $this->Mysqli->ExecuteDataSetArrayFull('uspActualizarPublicacion', $IdPublicacion, $nombrePub, $nombreArch, $rutaRepo, $Operacion);
    }
    
    public function ValidarExistenciaPublicacion($IdPublicacion, $NombrePublicacion, $NombreArchivo)
    {
        $i=0;
        $Rawdata = array();
        $resultlocal = $this->Mysqli->ExecuteDataSetArray('uspValidarExistenciaPublicacion', $IdPublicacion, $NombrePublicacion, $NombreArchivo);

        while($row = mysqli_fetch_array($resultlocal))
		{
			$Rawdata[$i] = $row;
			$i++;
        }
        
        return $Rawdata[0]["IdMensaje"];
    }

    public function InsertarSolicitudDescarga($pIdPublicacion, $pNombreCompleto, $pInstitucion, $pIdTipoPersona, $pAreaCarrera, $pCorreoElectronico)
    {
        $i=0;
        $Rawdata = array();
        $resultlocal = $this->Mysqli->ExecuteDataSetArray('uspInsertarInformacionDescarga', $pIdPublicacion, $pNombreCompleto, $pInstitucion, $pIdTipoPersona, $pAreaCarrera, $pCorreoElectronico);

        while($row = mysqli_fetch_array($resultlocal))
		{
			$Rawdata[$i] = $row;
			$i++;
        }
        
        return $Rawdata[0]["URlDescarga"];
    }
}
?>