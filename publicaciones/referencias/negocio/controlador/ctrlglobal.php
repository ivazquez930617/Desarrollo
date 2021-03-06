<?php
include_once "C:\\xampp7\\htdocs\\publicaciones\\referencias\\html\\html.php";

class CtrlGlobal
{
	var $Html;
	var $Log;

	public function __construct()
    {
		$this->Html = new Html();
		$this->Log = "log.log";
    }

	public function RenderizarMenu($pagina)
	{
		echo "<nav class=\"navbar navbar-expand-sm bg-primary navbar-dark fixed-top\">\n";
			echo "<ul class=\"navbar-nav\">\n";
				echo "<li class=\"".(($pagina=="Administrador") ? "nav-item active" : "nav-item")."\">\n";
					$this->Html->Link('LkAdministrador','Administrador', 'administrador.php', 'class=nav-link');
				echo "</li>\n";
				echo "<li class=\"".(($pagina=="Salir") ? "nav-item active" : "nav-item")."\">\n";
					$this->Html->Link('LkSalir','Salir', 'http://127.0.0.1:8080/publicaciones/procesos/saliracceso.php', 'class=nav-link');
				echo "</li>\n";
			echo "</ul>\n";
		echo "</nav>\n";
	}

	public function RenderizarMenuPublicaciones($pagina)
	{
		echo "<nav class=\"navbar navbar-expand-sm bg-primary navbar-dark fixed-top\">\n";
			echo "<ul class=\"navbar-nav\">\n";
				echo "<li class=\"".(($pagina=="Publicaciones") ? "nav-item active" : "nav-item")."\">\n";
					$this->Html->Link('LkPublicaciones','Publicaciones', 'index.php', 'class=nav-link');
				echo "</li>\n";
			echo "</ul>\n";
		echo "</nav>\n";
	}

	public function RenderizarScripts()
	{
		ob_start();
		include "_layoutscriptsheader.php";
		$cont = ob_get_clean();
		echo $cont;
	}

	public function RenderizarPie()
	{
		ob_start();
		include "_layoutfoother.php";
		$cont = ob_get_clean();
		echo $cont;
	}

	public function EscribirLog($textoLog){
		$actual = file_get_contents($this->Log);
		$actual = $actual.date("Y-m-d H:i:s")."-".$textoLog.PHP_EOL;

		file_put_contents($this->Log, $actual);
	}
}





