
<?php
class BaseDatos
{
	public function Conecta()
	{
		$servername = "127.0.0.1";
		$username = "root";
		$password = "";
		$dbname = "chap_publicaciones";
       
		$conn = new mysqli($servername, $username, $password, $dbname);

		return $conn;
	}
}
?>