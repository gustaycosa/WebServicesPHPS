<!DOCTYPE html>
<html class="no-js">

<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Pantallas'); ?>
<?php
    $TituloPantalla = 'Pantallas';  
	//$Arreglo = array("Nombre","Saldo");
	//echo PasaArreglo($Arreglo);
?>

<body>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 id="cabecera">
                <?php echo $TituloPantalla; /*Incluir modal nvo*/?>
            </h6>
        </div>
        <div class="panel-body">
            <form id="formulario" method="POST" class="form-inline">
                <input type="hidden" id="TxtClave" name="TxtClave">
                <input type="search" id="ejemplo" name="ejemplo">
                <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
                <button type="button" id="btnNuevo" class="btn btn-primary btn-sm" onMouseOver="" data-toggle="modal" data-target="#mdlnvo">Nuevo</button>
                <button type="button" id="btnEliminar" class="btn btn-primary btn-sm" onMouseOver="">Eliminar</button>
                <button class="btn btn-primary btn-sm buttons-copy buttons-html5" tabindex="0" aria-controls="grid" type="button"><span>Copiar</span></button>

            </form>
            <div class="respuesta"></div>
            <div class="form-inline">
                <div class="modal-footer col-sm-2">
                    <?php echo BusquedaGrid(0,'nombre');?>
                </div>
                <div class="modal-footer col-sm-12">
                    <?php echo HtmlButtons();?>
                </div>
            </div>
            <?php echo CargaGif();?>
            <div class='modal bs-example-modal-sm' id='mdlnvo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                <div class='modal-dialog modal-sm' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <h4 class='modal-title' id='myModalLabel'>Agregar pantalla</h4>
                        </div>
                        <div id='mdldivnvo' class='modal-body'>
                            <form id="frmnvo" class="form-horizontal" method="POST">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="txtnombre" class="form-control" id="txtnombre" placeholder="nombre clave">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="txtdescrip" class="form-control" id="txtdescrip" placeholder="Nombre mostrado en panalla">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select id="cmbtipo" name="cmbtipo" class="form-control">
                                            <option value="WEB">WEB</option>
                                            <option value="WIN">WIN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php echo CmbCualquieras('id_modulo','modulo','modulos'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php echo CmbCualquieras('id_grupo','grupo','grupos'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary col-sm-12" id="btnagregar">Agregar pantalla</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo MdlSearch('MdlMaqDet','Detalle maquinaria');?>
        </div>
    </div>
</body>

<?php echo Script(); ?>

<script type="text/javascript">
    $(function() {
        <?php echo JqueryButtons();?>

        $("form#formulario").on('submit', function(e) {
            e.preventDefault();
            $('#CargaGif').show();
            $('#btnEnviar').attr('disabled', 'disabled')
            $.ajax({
                type: "POST",
                url: 'tabla-gobpantallas.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    $('#btnEnviar').removeAttr('disabled');
                    $(".respuesta").html(data); // Mostrar la respuestas del script PHP.
                    $(".respuesta").show();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false; // Evitar ejecutar el submit del formulario.
        });

        $("form#frmnvo").on('submit', function(e) {
            e.preventDefault();
            $('#CargaGif').show();
            //$('#btnEnviar').attr('disabled', 'disabled')
            $.ajax({
                type: "POST",
                url: 'tabla-gobpantallasnvo.php',
                data: $("form#frmnvo").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    $('#mdlnvo').modal('hide');
                    alert('Usuario agregado :)');
                    //$('#grid').DataTable().draw();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false; // Evitar ejecutar el submit del formulario.
        });
    });

    $(document).on('click', '#BtnNuevo', function() {
        var id = $(this).attr("id");
        $("#TxtClave").val(id);
        $('#CargaGif').show();
        $.ajax({
            type: "POST",
            url: 'tabla-tallmaqusadadet.php',
            data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
            success: function(data) {
                //$('#btnEnviar').removeAttr('disabled');
                $('#CargaGif').hide();
                $("#DivMdlMaqDet").html(data); // Mostrar la respuestas del script PHP.
                $("#DivMdlMaqDet").show();
                $('#MdlMaqDet').modal('show')
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; // Evitar ejecutar el submit del formulario.	
    });

    $(document).on('click', '#btnEliminar', function() {
        $('#CargaGif').show();
        $.ajax({
            type: "POST",
            url: 'del-gobusr.php',
            data: $("form#formulario").serialize(), // Adjuntar los campos del formulario enviado.
            success: function(data) {
                //$('#btnEnviar').removeAttr('disabled');
                $('#CargaGif').hide();
                alert('Usuario eliminado :)');
                $('#grid').DataTable().draw();
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; // Evitar ejecutar el submit del formulario.	
    });

    $(document).on('dblclick', '#grid tr', function() {
        var id = $(this).attr("id");
        $("#TxtClave").val(id);
        $('#CargaGif').show();
        $.ajax({
            type: "POST",
            url: 'tabla-tallmaqusadadet.php',
            data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
            success: function(data) {
                //$('#btnEnviar').removeAttr('disabled');
                $('#CargaGif').hide();
                $("#DivMdlMaqDet").html(data); // Mostrar la respuestas del script PHP.
                $("#DivMdlMaqDet").show();
                $('#MdlMaqDet').modal('show')
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; // Evitar ejecutar el submit del formulario.	
    });
    $(document).on('click', '#grid tr', function() {
        var id = $(this).attr("id");
        $("#TxtClave").val(id);
    });

</script>

</html>
