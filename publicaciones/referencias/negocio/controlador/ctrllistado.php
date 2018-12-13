<?php
include_once "C:\\xampp7\\htdocs\\publicaciones\\referencias\\basedatos\\mysql.php";

class CtrlListado
{
    var $Mysqli;
    var $Rawdata;

    public function __construct()
    {
	    $this->Mysqli = new Mysql();
	    $this->Rawdata = array();
    }

    public function ListarPublicaciones($ModuloListado){
    	return $this->Mysqli->ExecuteDataSetArray('uspListarPublicaciones', $ModuloListado);
    }

    public function ObtenerCatalogoTipoPersona(){
    	return $this->Mysqli->ExecuteDataSetArray('uspObtenerCatalogoTipoPersona');
    }
    
    public function BuscarPublicaciones($pNombre){
        return $this->Mysqli->ExecuteDataSetArray('uspListarPublicacionesPorBusqueda', $pNombre);
    }
}
?>