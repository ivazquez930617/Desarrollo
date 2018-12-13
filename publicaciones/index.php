<?php
    include_once "referencias/negocio/controlador/ctrlglobal.php";
    include_once "referencias/negocio/controlador/ctrllistado.php";
    include_once "referencias/html/html.php";

    $ControladorGlobal = new CtrlGlobal();
    $ControladorListado = new CtrlListado();
    $Html = new Html();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="include/css/dropzone.css" />
    <script type="text/javascript" src="include/js/dropzone.js"></script>

    <?php $ControladorGlobal->RenderizarScripts(); ?>

    <script type="text/javascript">
        function MostrarModalCargaArchivos(id, idPublicacion){
            document.getElementById("IdPublicacion").value = idPublicacion;

            alertify.genericDialog || alertify.dialog('genericDialog',function(){
            return {
                main:function(content){
                    this.setContent(content);
                },
                setup:function(){
                    return {
                        options:{
                            basic:true,
                            maximizable:false,
                            resizable:false,
                            padding:true
                        }
                    };
                }
            };
        });
        
        alertify.genericDialog($(id)[0]);
    }

    function BuscarPublicacion(){
        var parametros = {
                        "TxtBuscar" : document.getElementById("TxtBuscar").value
                    };

        $.ajax(
        {
            data:  parametros, 
            url:   'procesos/buscarpublicacion.php',
            type:  'post',
            beforeSend: function () {   
            },
            success:  function (response) {
                $('#Contendor-Listado-Busqueda').html(response);
            },
            error: function() {
                alertify.error('Ha ocurrido un error');
            }
        });
    }
    </script> 
    <title>Publicaciones</title>   
</head>
<body>
    <?php $ControladorGlobal->RenderizarMenuPublicaciones("Publicaciones"); ?>

    <div id="Contendor-Busqueda">
        <table>
            <tr>
                <td><?php $Html->Label("LblBusqueda", "Nombre Publicaci&oacute;n:", "TxtBuscar", "class=\"form-control\""); ?></td>
                <td><?php $Html->TextBox("TxtBuscar", "", "class=\"form-control\"", "placeholder=\"Ingenieria social\""); ?></td>
                <td><?php $Html->Button("BtnBuscar", "Buscar", "class=\"btn\"", "onclick=\"BuscarPublicacion()\""); ?></td>
            </tr>
        </table>
    </div>
    <div id="Contendor-Listado-Busqueda">
        <?php $Html->Table("TabListadoPublicaciones", $ControladorListado->ListarPublicaciones(2), "class=\"table\""); ?>
    </div>

    <div id="contenedor-modal-grag">
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <div id="contenedor-drag">
                        <div class="image_upload_div">
                            <div id="form-solicitar-descarga">
                                <form id="needs-validation" novalidate>
                                    <div id="titulo-carga"><h5>Descarga de publicaciones</h5></div>
                                    <div id="titulo-descripcion"><h6>Por favor llena este formulario para descargar la publicaci&oacute;n </h6></div>
                                    <table id="contenedor-formulario-descarga">
                                        <tr>
                                            <td id="label-form-descarga"><?php $Html->Label("LblNombreCompleto", "Nombre Completo:", "TxtNombreCompleto"); ?></td>
                                            <td>
                                                <?php $Html->TextBox("TxtNombreCompleto", "", "class=\"form-control\"", "placeholder=\"Juan Ruiz Gomez\"", "pattern=\"[A-Za-z ]{3,100}\"", "required"); ?>
                                                <?php $Html->LabelError("Nombre no v&aacute;lido"); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="label-form-descarga"><?php $Html->Label("LblInstitucion", "Institucion:", "TxtInstitucion"); ?></td>
                                            <td>
                                                <?php $Html->TextBox("TxtInstitucion", "", "class=\"form-control\"", "placeholder=\"Tecnologico de Santa Ana\"", "pattern=\"[A-Za-z0-9 ]{5,100}\"", "required"); ?>
                                                <?php $Html->LabelError("Instituci&oacute;n no v&aacute;lida"); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="label-form-descarga"><?php $Html->Label("LblActividad", "Actividad:", "CbActividad"); ?></td>
                                            <td><?php $Html->ComboBox("CbActividad", $ControladorListado->ObtenerCatalogoTipoPersona(), "class=\"form-control\""); ?></td>
                                        </tr>
                                        <tr>
                                            <td id="label-form-descarga"><?php $Html->Label("LblAreaCarrera", "&Aacute;rea / Carrera:", "TxtAreaCarrera"); ?></td>
                                            <td>
                                                <?php $Html->TextBox("TxtAreaCarrera", "", "class=\"form-control\"", "placeholder=\"Ingenieria en Sistemas\"", "pattern=\"[A-Za-z ]{5,100}\"", "required"); ?>
                                                <?php $Html->LabelError("&Aacute;rea / Carrera no v&aacute;lida"); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="label-form-descarga"><?php $Html->Label("LblCorreo", "Correo Electr&oacute;nico:", "TxtCorreo"); ?></td>
                                            <td>
                                                <?php $Html->TextBox("TxtCorreo", "", "class=\"form-control\"", "placeholder=\"micorreo@gmail.com\"", "pattern=\"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$\"", "required"); ?>
                                                <?php $Html->LabelError("Correo no v&aacute;lido"); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <?php $Html->ButtonSubmit("BtnEnviar", "Enviar", "class=\"btn btn-danger\""); ?>
                                                <?php $Html->Hidden("IdPublicacion", ""); ?>
                                            </td>
                                        </tr>
                                    </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
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
                        "IdPublicacion" : document.getElementById("IdPublicacion").value,
                        "TxtNombreCompleto" : document.getElementById("TxtNombreCompleto").value,
                        "TxtInstitucion" : document.getElementById("TxtInstitucion").value,
                        "CbActividad" : document.getElementById("CbActividad").value,
                        "TxtAreaCarrera" : document.getElementById("TxtAreaCarrera").value,
                        "TxtCorreo" : document.getElementById("TxtCorreo").value
                    };

        $.ajax(
        {
            data:  parametros, 
            url:   'procesos/solicituddescarga.php',
            type:  'post',
            beforeSend: function () {   
            },
            success:  function (response) {
                $('#needs-validation').html(response);
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