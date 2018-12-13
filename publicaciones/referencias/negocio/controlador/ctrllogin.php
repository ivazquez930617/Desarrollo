<?php
include_once "C:\\xampp7\\htdocs\\publicaciones\\referencias\\basedatos\\mysql.php";

class CtrlLogin
{
    var $Mysqli;
    var $Rawdata;

    public function __construct()
    {
	    $this->Mysqli = new Mysql();
	    $this->Rawdata = array();
    }

    public function ValidarAcceso($NombreUsuario, $Password){
    	$i=0;
        $Rawdata = array();
        $resultlocal = $this->Mysqli->ExecuteDataSetArray('uspValidarAccesoUsuario', $NombreUsuario, $Password);

        while($row = mysqli_fetch_array($resultlocal))
		{
			$Rawdata[$i] = $row;
			$i++;
        }

        return "{\"IdMensaje\":".$Rawdata[0]["IdMensaje"].",\"Mensaje\":\"".$Rawdata[0]["Mensaje"]."\"}";
    }
}
?>