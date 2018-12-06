<?php
include_once "referencias/basedatos/mysql.php";

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

    public function ValidarExistenciaPublicacion($nombreArch)
    {
        $i=0;
        $Rawdata = array();
        $resultlocal = $this->Mysqli->ExecuteDataSetArray('uspValidarExistenciaPublicacion', $nombreArch);

        while($row = mysqli_fetch_array($resultlocal))
		{
			$Rawdata[$i] = $row;
			$i++;
        }
        
        return $Rawdata[0]["IdMensaje"];
    }
}
?>