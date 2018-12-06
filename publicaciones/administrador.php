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
        function ActualizarPagina(){
            location.href = "http://127.0.0.1:8080/publicaciones/administrador.php";
        }

        function Eliminar(IdPublicacion, RutaArchivo)
        {
            alertify.confirm(
                "Se eliminar&aacute; esta publicaci&oacute;n junto con todas sus dependencias. ¿Desea continuar realmente?",
                function()
                {
                    var parametros = {
                        "IdPublicacion" : IdPublicacion,
                        "RutaArchivo" : RutaArchivo
                    };

                    $.ajax(
                    {
                        data:  parametros, 
                        url:   'eliminararchivo.php',
                        type:  'post',
                        beforeSend: function () {   
                        },
                        success:  function (response) {
                            $('#Contendor-Listado').html(response);
                            alertify.success('La publicaci&oacute;n se ha eliminado exitosamente');
                        },
                        error: function() {
                            alertify.error('Ha ocurrido un error');
                        }
                    });
                },
                function(){}
            );
        }

        function MostrarModalCargaArchivos(){
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
        
        alertify.genericDialog($('#form-drag-drop')[0]);
    }
    </script> 
    <title>Administrador</title>   
</head>
<body>
    <?php $ControladorGlobal->RenderizarMenu("Administrador"); ?>

    <div id="Contendor-Listado">
        <?php $Html->Table("TabListadoPublicaciones", $ControladorListado->ListarPublicaciones(), "class=\"table\""); ?>
    </div>

    <div id="contenedor-modal-grag">
        <button type="button" class="btn" onclick="MostrarModalCargaArchivos()">Cargar Publicaci&oacute;n</button>
        
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Carga de publicaciones</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <div id="contenedor-drag">
                        <div class="image_upload_div">
                            <form action="cargararchivo.php" class="dropzone" id="form-drag-drop">
                                <div id="titulo-carga"><h5>Carga de publicaciones</h5></div>
                                <div id="boton-finalizar">
                                    <button type="button" class="btn btn-danger" onclick="ActualizarPagina()">Finalizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>