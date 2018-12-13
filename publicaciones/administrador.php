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
        var actualizanombre;

        function Actualizar(Id, element, IdPublicacion, RutaArchivo){
            document.getElementById("IdPublicacion").value = IdPublicacion;
            document.getElementById("RutaArchivo").value = RutaArchivo;
            MostrarModalCargaArchivos(Id, element);
        }

        function FinalizarCarga(){
            location.href = "http://127.0.0.1:8080/publicaciones/administrador.php";
        }

        function FinalizarActualizacion(){
            
            if(actualizanombre == true){
                if(document.getElementById("TxtNombrePublicacionPub").value == ""){
                    alertify.alert("El nombre de la publicaci&oacute;n no puede estar vacio", function(){});
                }
                else
                {
                    alertify.confirm(
                        "Se actualizar&aacute; el nombre de esta publicaci&oacute;n. ¿Desea continuar realmente?",
                        function()
                        {
                            var parametros = {
                                "IdPublicacion" : document.getElementById("IdPublicacion").value,
                                "TxtNombrePublicacion" : document.getElementById("TxtNombrePublicacionPub").value,
                                "MantenerNombrePublicacion" : document.getElementById("MantenerNombrePublicacion").value
                            };

                            $.ajax(
                            {
                                data:  parametros, 
                                url:   'procesos/actualizarnombrepublicacion.php',
                                type:  'post',
                                beforeSend: function () {   
                                },
                                success:  function (response) {
                                    $('#Contendor-Listado').html(response);
                                    alertify.success('El nombre de la publicaci&oacute;n se ha actualizado exitosamente');
                                    location.href = "http://127.0.0.1:8080/publicaciones/administrador.php";
                                },
                                error: function() {
                                    alertify.error('Ha ocurrido un error');
                                }
                            });
                        },
                        function(){
                            location.href = "http://127.0.0.1:8080/publicaciones/administrador.php";
                        }
                        );
                    }
            }
            else
            {
                location.href = "http://127.0.0.1:8080/publicaciones/administrador.php";
            }
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
                        url:   'procesos/eliminararchivo.php',
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

        function MostrarModalCargaArchivos(id, element){
            document.getElementById("cubre-drag-drop").style.display = "none";

            if(document.getElementById("ChkMantenerNombre").checked == true){
                DeshabilitarNombrePublicacion(element);
            }

            if(document.getElementById("ChkMantenerNombrePub").checked == true){
                DeshabilitarNombrePublicacion(element);
            }

            if(id == "form-drag-dropAct"){
                if(document.getElementById("ChkMantenerSoloNombrePub").checked == true){
                    DeshabilitarNombrePublicacion(element);
                }
            }

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

    function MarcarSoloNombre(element){
        HabilitarNombrePublicacion(element);
        document.getElementById("cubre-drag-drop").style.display = "block";
        actualizanombre = true;
    }

    function HabilitarNombrePublicacion(element){
        actualizanombre = false;
        document.getElementById(element).disabled = false;
        document.getElementById("cubre-drag-drop").style.display = "none";
    }

    function DeshabilitarNombrePublicacion(element){
        actualizanombre = false;
        document.getElementById(element).disabled = true;
        document.getElementById(element).value = "";
        document.getElementById("cubre-drag-drop").style.display = "none";
    }
    
    function CambiarTipoActualizacion(valor){
        document.getElementById("MantenerNombrePublicacion").value = valor;
    }
    </script> 
    <title>Administrador</title>   
</head>
<body>
    <?php $ControladorGlobal->RenderizarMenu("Administrador"); ?>

    <div id="Contendor-Listado">
        <?php $Html->Table("TabListadoPublicaciones", $ControladorListado->ListarPublicaciones(1), "class=\"table\""); ?>
    </div>

    <div id="contenedor-modal-grag">
        <?php $Html->Button("BtncargaPubs", "Cargar Publicaci&oacute;n", "class=\"btn\"", "onclick=\"MostrarModalCargaArchivos('#form-drag-drop', 'TxtNombrePublicacion')\""); ?>
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
                            <form action="procesos/cargararchivo.php" class="dropzone" id="form-drag-drop">
                                <div id="titulo-carga"><h5>Carga de publicaciones</h5></div>
                                <div id="controles">
                                    <?php $Html->RadioButton("ChkMantenerNombre", "NombreArchivo", "Mantener el nombre del archivo", "Mantiene", "Checked", "onclick=\"DeshabilitarNombrePublicacion('TxtNombrePublicacion');\""); ?><br>
                                    <?php $Html->RadioButton("ChkEditarNombre", "NombreArchivo", "Escribir un nombre", "Escribe", "onclick=\"HabilitarNombrePublicacion('TxtNombrePublicacion');\""); ?>
                                    <table id="form-carga-act">
                                        <tr>
                                            <td><div id="fuente-labels"><?php $Html->Label("LblPublicacion", "Nombre publicaci&oacute;n:", "TxtNombrePublicacion"); ?></div></td>
                                            <td><?php $Html->TextBox("TxtNombrePublicacion", "", "class=\"form-control\"", "placeholder=\"El venir del nuevo milenio\""); ?></td>
                                        </tr>
                                    </table>
                                    <?php $Html->Hidden("TipoOperacion", "1"); ?>
                                </div>
                                <div id="boton-finalizar">
                                    <?php $Html->Button("BtnFinalizarCarga", "Finalizar", "class=\"btn btn-danger\"", "onclick=\"FinalizarCarga()\""); ?>
                                </div>
                            </form>
                            <form action="procesos/cargararchivo.php" class="dropzone" id="form-drag-dropAct">
                                <div id="titulo-carga"><h5>Actualizar Publicaci&oacute;n</h5></div>
                                <div id="controles">
                                    <?php $Html->RadioButton("ChkMantenerNombrePub", "NombrePub", "Cargar archivo y mantener el nombre de la publicaci&oacute;n", "Mantiene", "Checked", "onclick=\"DeshabilitarNombrePublicacion('TxtNombrePublicacionPub');CambiarTipoActualizacion(3);\""); ?><br>
                                    <?php $Html->RadioButton("ChkEditarNombrePub", "NombrePub", "Cargar archivo y cambiar nombre de la publicaci&oacute;n", "Escribe", "onclick=\"HabilitarNombrePublicacion('TxtNombrePublicacionPub');CambiarTipoActualizacion(1);\""); ?><br>
                                    <?php $Html->RadioButton("ChkEditarSoloNombrePub", "NombrePub", "Cambiar nombre de la publicaci&oacute;n sin cargar archivo", "Escribe", "onclick=\"MarcarSoloNombre('TxtNombrePublicacionPub');CambiarTipoActualizacion(2);\""); ?>
                                    <table id="form-carga-act">
                                        <tr>
                                            <td><div id="fuente-labels"><?php $Html->Label("LblPublicacion", "Nombre publicaci&oacute;n:", "TxtNombrePublicacion"); ?></div></td>
                                            <td><?php $Html->TextBox("TxtNombrePublicacionPub", "", "class=\"form-control\"", "placeholder=\"El venir del nuevo milenio\""); ?></td>
                                        </tr>
                                    </table>
                                    <?php $Html->Hidden("TipoOperacion", "2"); ?>
                                    <?php $Html->Hidden("IdPublicacion", ""); ?>
                                    <?php $Html->Hidden("RutaArchivo", ""); ?>
                                    <?php $Html->Hidden("MantenerNombrePublicacion", "3"); ?>
                                    <div id="cubre-drag-drop"></div>
                                </div>
                                <div id="boton-finalizar">
                                    <?php $Html->Button("BtnFinalizarActualizacion", "Finalizar", "class=\"btn btn-danger\"", "onclick=\"FinalizarActualizacion()\""); ?>
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