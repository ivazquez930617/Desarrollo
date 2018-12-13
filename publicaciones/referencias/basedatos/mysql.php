<?php
include_once "C:\\xampp7\\htdocs\\publicaciones\\referencias\\basedatos\\basedatos.php";
include_once "C:\\xampp7\\htdocs\\publicaciones\\referencias\\negocio\\controlador\\ctrlglobal.php";
	
class Mysql
{
	var $bd;
	var $ControladorGlobal;

	public function __construct()
    {
		$this->bd = new BaseDatos();
		$this->ControladorGlobal = new CtrlGlobal();
    }

	public function ExecuteDataSetArray($stored, ...$params)
	{
    	$Con = $this->bd->Conecta();
		$Argumentos = "";

	    foreach ($params as $Dato){
	    	if(is_bool($Dato) || is_null($Dato) || is_float($Dato) || is_int($Dato)){
	    		$Dato = $Dato;
	    	}
	    	if(is_string($Dato)){
	    		$Dato = "'".$Dato."'";
	    	}
	    	
	        $Argumentos = $Argumentos.$Dato.",";
	    }
	    
	    $Argumentos = substr($Argumentos,0,strlen($Argumentos)-1);
		mysqli_set_charset($Con, "utf8");
		$this->ControladorGlobal->EscribirLog("call ".$stored."(".$Argumentos.")");

	    if(!$result = mysqli_query($Con, "call ".$stored."(".$Argumentos.")")) die();
	   
	    //mysqli_close($Con);
	    return $result;
	}

	public function ExecuteDataSetArrayFull($stored, ...$params)
	{
    	$Con = $this->bd->Conecta();
		$Argumentos = "";

	    foreach ($params as $Dato){
	    	if(is_bool($Dato) || is_null($Dato) || is_float($Dato) || is_int($Dato)){
	    		$Dato = $Dato;
	    	}
	    	if(is_string($Dato)){
	    		$Dato = "'".$Dato."'";
	    	}
	    	
	        $Argumentos = $Argumentos.$Dato.",";
	    }
	    
	    $Argumentos = substr($Argumentos,0,strlen($Argumentos)-1);
		mysqli_set_charset($Con, "utf8");
		$this->ControladorGlobal->EscribirLog("call ".$stored."(".$Argumentos.")");
		
	    mysqli_query($Con, "call ".$stored."(".$Argumentos.")");
	}
}
?>