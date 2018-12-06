<?php
    include_once "referencias/negocio/controlador/ctrlglobal.php";
    include_once "referencias/html/html.php";

    $ControladorGlobal = new CtrlGlobal();
    $Html = new Html();
?>
<!DOCTYPE html>
<html>
<head>
    <?php $ControladorGlobal->RenderizarScripts(); ?>
    <title>Acceso Publicaciones</title>
</head>
<body>
    <div id="form-ingreso">
        <table>
        <tr>
            <td><?php $Html->Label("LblUsuario", "Usuario:", "Txtusuario","Class=\"form-control\""); ?></td>
            <td><?php $Html->TextBox("TxtUsuario","","Class=\"form-control\""); ?></td>
        </tr>
        <tr>
            <td><?php $Html->Label("LblPassword", "Password:", "TxtPassword", "Class=\"form-control\""); ?></td>
            <td><?php $Html->TextBoxPassword("TxtPassword","", "Class=\"form-control\""); ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php $Html->Button("BtnIngresar","Ingresar","Class=\"btn btn-info\"") ?></td>
        </tr>
        </table>
    </div>
</body>
</html>