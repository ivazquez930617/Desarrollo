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
    <title>Acceso Administrador Publicaciones</title>
</head>
<body>
    <div id="form-ingreso">
        <form id="needs-validation" novalidate>
            <table>
            <tr>
                <td><?php $Html->Label("LblUsuario", "Usuario:", "Txtusuario","Class=\"form-control\""); ?></td>
                <td>
                    <?php $Html->TextBox("TxtUsuario", "", "Class=\"form-control\"", "pattern=\".{6,60}\"", "required"); ?>
                    <?php $Html->LabelError("Usuario no v&aacute;lido"); ?>
                </td>
            </tr>
            <tr>
                <td><?php $Html->Label("LblPassword", "Password:", "TxtPassword", "Class=\"form-control\""); ?></td>
                <td>
                    <?php $Html->TextBoxPassword("TxtPassword", "", "Class=\"form-control\"", "pattern=\".{6,60}\"", "required"); ?>
                    <?php $Html->LabelError("Password no v&aacute;lida"); ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><?php $Html->ButtonSubmit("BtnIngresar", "Ingresar", "Class=\"btn btn-info\"") ?></td>
            </tr>
            </table>
            <div id="MensajeSistema"></div>
        </form>
    </div>
<script>
(function() {
  'use strict';

  window.addEventListener('load', function() {
    var form = document.getElementById('needs-validation');
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }else{
        event.preventDefault();
        event.stopPropagation();

        var parametros = {
                            "NombreUsuario" : document.getElementById("TxtUsuario").value,
                            "Password" : document.getElementById("TxtPassword").value
                        };

        $.ajax(
        {
            data:  parametros, 
            url:   'procesos/validaacceso.php',
            type:  'post',
            dataType: "json",
            beforeSend: function () {   
            },
            success:  function (response) {
                var idMensaje = response.IdMensaje;
                var mensaje = response.Mensaje;

                if (idMensaje == 0) {
                    alertify.error(mensaje);
                    document.getElementById("MensajeSistema").innerHTML = "<div class=\"alert alert-danger\"><strong>¡Error!</strong><p>" + mensaje + "</p></div>";

                    document.getElementById("TxtUsuario").value = "";
                    document.getElementById("TxtPassword").value = "";
                }

                if (idMensaje == 1) {
                    location.href = mensaje;
                }
            },
            error: function() {
                alertify.error('Ha ocurrido un error');
            }
        });
      }
      form.classList.add('was-validated');
    }, false);
  }, false);
})();
</script>    
</body>
</html>