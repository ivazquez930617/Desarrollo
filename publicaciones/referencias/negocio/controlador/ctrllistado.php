<?php
include_once "referencias/basedatos/mysql.php";

class CtrlListado
{
    var $Mysqli;
    var $Rawdata;

    public function __construct()
    {
	    $this->Mysqli = new Mysql();
	    $this->Rawdata = array();
    }

    public function ListarPublicaciones(){
    	return $this->Mysqli->ExecuteDataSetArray('uspListarPublicaciones');
    }
}
?>