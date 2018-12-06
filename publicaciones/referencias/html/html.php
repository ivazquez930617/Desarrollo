<?php
class Html
{
	public function __construct()
    {
    }

	public function Link($id, $leyenda, $url, ...$params){
		$Argumentos = "";
	    foreach ($params as $Dato){
	        $Argumentos = $Argumentos.$Dato." ";
	    }
		echo "<a href=\"".$url."\" id=\"".$id."\" ".$Argumentos.">".$leyenda."</a>\n";
	}

	public function Label($id, $leyenda, $asignado, ...$params){
		$Argumentos = "";
	    foreach ($params as $Dato){
	        $Argumentos = $Argumentos.$Dato." ";
	    }
		echo "<label for=\"".$asignado."\" id=\"".$id."\" \"".$Argumentos."\">".$leyenda."</label>\n";
	}

	public function TextBox($id, $texto, ...$params){
		$Argumentos = "";
	    foreach ($params as $Dato){
	        $Argumentos = $Argumentos.$Dato." ";
	    }
		echo "<input type=\"text\" value=\"".$texto."\" id=\"".$id."\" ".$Argumentos.">\n";
	}

	public function TextBoxPassword($id, $texto, ...$params){
		$Argumentos = "";
	    foreach ($params as $Dato){
	        $Argumentos = $Argumentos.$Dato." ";
	    }
		echo "<input type=\"password\" value=\"".$texto."\" id=\"".$id."\" ".$Argumentos.">\n";
	}

	public function DateTime($id, ...$params){
		$Argumentos = "";
	    foreach ($params as $Dato){
	        $Argumentos = $Argumentos.$Dato." ";
	    }
		echo "<input type=\"date\" ".$Argumentos.">";
	}

	public function Button($id, $leyenda, ...$params){
		$Argumentos = "";
	    foreach ($params as $Dato){
	        $Argumentos = $Argumentos.$Dato." ";
	    }
		echo "<button type=\"button\" id=\"".$id."\" ".$Argumentos.">".$leyenda."</button>\n";
	}

	public function Table($id, $result, ...$params){
		
		$Argumentos = "";
		foreach ($params as $Dato){
			$Argumentos = $Argumentos.$Dato." ";
		}
		echo "<table id=\"".$id."\" ".$Argumentos.">\n";

		$Columnas = "";
		$Rawdata = array();
		$resultlocal = $result;
		$i=0;

		while($row = mysqli_fetch_array($resultlocal))
		{
			$Rawdata[$i] = $row;
			$i++;
		}

		if($Rawdata != null){
			//$keys = array_keys($Rawdata[0]);
			foreach($Rawdata[0] as $key => $value) 
			{
				$Columnas = $Columnas.",".$key.",";
			}

			$Columnas = str_replace(',0,', ',', $Columnas);
			$Columnas = str_replace(',1,', ',', $Columnas);
			$Columnas = str_replace(',2,', ',', $Columnas);
			$Columnas = str_replace(',3,', ',', $Columnas);
			$Columnas = str_replace(',4,', ',', $Columnas);
			$Columnas = str_replace(',5,', ',', $Columnas);
			$Columnas = str_replace(',6,', ',', $Columnas);
			$Columnas = str_replace(',7,', ',', $Columnas);
			$Columnas = str_replace(',8,', ',', $Columnas);
			$Columnas = str_replace(',9,', ',', $Columnas);
			$Columnas = str_replace(',,,', ',', $Columnas);
			$Columnas = str_replace(',,', ',', $Columnas);
			$Columnas = substr($Columnas,1,strlen($Columnas));
			$Columnas = substr($Columnas,0,strlen($Columnas) - 1);

			$columns = explode(",", $Columnas);

			$this->RowHeader($columns);

			echo "\t<tbody>\n";
			foreach ($Rawdata as $celda) {
				$this->Rows($columns, $celda);
			}
			echo "\t</tbody>\n";
			
			echo "</table>";
		}
		else
		{
			echo "<h5>Sin registros en la base de datos<h5>";
		}
	}

	private function Cell($celda, $filas){
		echo "\t\t<td id=\"td_".str_replace(" ", "", $filas)."\">".$celda."</td>\n";
	}

	private function CellHeader($celda){
		echo "\t\t<th id=\"th_".str_replace(" ", "", $celda)."\">".$celda."</th>\n";
	}

	private function RowHeader($column){
		echo "\t<thead class=\"thead-light\">\n";
		echo "\t<tr>\n";
    	foreach ($column as $fila) {
    		$this->CellHeader($fila);
    	}
		echo "\t</tr>\n";
		echo "\t</thead>\n";
	}

	private function Rows($column, $celda){
		echo "\t<tr>\n";
		foreach ($column as $filas) {
    		$this->Cell($celda[$filas], $filas);
    	}
		echo "\t</tr>\n";
	}

	public function Free($id, $result, ...$params)
	{
		$resultlocal = $result;
    	$i=0;

		while($row = mysqli_fetch_array($resultlocal))
	    {
	        echo $row["salida"];
	        $i++;
	    }
	}
}
?>