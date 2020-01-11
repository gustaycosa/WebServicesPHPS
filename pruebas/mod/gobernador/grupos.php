<?php include("validasesion.php"); ?>
<!DOCTYPE html>
<html class="no-js">

<?php 
    include("../../funciones.php"); 
    $TituloPantalla = 'Grupos';
    echo Cabecera($TituloPantalla);    
?>

<body>
    <div class="panel panel-default">
       <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
            <h6 id="cabecera">
                <?php echo $TituloPantalla; ?>
            </h6>
        </div>
        <div class="panel-body">
            <form id="formulario" method="POST" class="form-inline">
                <input type="hidden" id="TxtClave" name="TxtClave">
                <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
                <button type="button" id="btnNuevo" class="btn btn-primary btn-sm" onMouseOver="" data-toggle="modal" data-target="#mdlnvo">Nuevo</button>
                <button type="button" id="btnEliminar" class="btn btn-primary btn-sm" onMouseOver="">Eliminar</button>
            </form>
            <div class="respuesta"></div>
            <div class="form-inline">
                <div class="modal-footer col-sm-2">
                    <?php echo BusquedaGrid(0,'nombre');?>
                </div>
                <div class="modal-footer col-sm-10">
                    <?php echo HtmlButtons();?>
                </div>
            </div>
            <div class='modal bs-example-modal-sm' id='mdlnvo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                <div class='modal-dialog modal-sm' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <h4 class='modal-title' id='myModalLabel'>Agregar grupos</h4>
                        </div>
                        <div id='mdldivnvo' class='modal-body'>
                            <form id="frmnvo" class="form-horizontal" method="POST">
                                <input type="hidden" id="TxtId" name="TxtId">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="txtperfil" class="form-control" id="txtperfil" placeholder="Nombre del perfil">
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" name="txtdescripcion" class="form-control" id="txtdescripcion" placeholder="Pequeña descripcion del perfil">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary col-sm-12" id="btnagregar">Crear grupo</button>
                                        <button type="submit" class="btn btn-primary col-sm-12" id="btnactualizar">Actualizar usuario</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo CargaGif();?>
        </div>
    </div>
</body>

<?php echo Script(); ?>

<script type="text/javascript">
    var timer = 0;
    var id = 0;
    
    $(function() {
        <?php echo JqueryButtons();?>

        $("form#formulario").on('submit', function(e) {
            e.preventDefault();
            $('#CargaGif').show();
            $('#btnEnviar').attr('disabled', 'disabled')
            $.ajax({
                type: "POST",
                url: 'tabla-gobgrupo.php',
                data: $("form").serialize(),
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
    });
    $(document).on('click', '#BtnNuevo', function() {
        $("#TxtClave").val(id);
        $('#CargaGif').show();
        $.ajax({
            type: "POST",
            url: 'tabla-tallmaqusadadet.php',
            data: $("form#frmnvo").serialize(),
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
        return false;
    });

    $(document).on('click', '#btnagregar', function() {
        e.preventDefault();
        $('#CargaGif').show();
        //$('#btnEnviar').attr('disabled', 'disabled')
        $.ajax({
            type: "POST",
            url: 'nvo-gobusr.php',
            data: $("form#frmnvo").serialize(),
            success: function(data) {
                $('#CargaGif').hide();
                $('#mdlnvo').modal('hide');
                alert('Usuario agregado :)');
                $('#grid').DataTable().draw();
                $('#frmnvo').reset();
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false;
    });

    $(document).on('click', '#btnactualizar', function() {
        $("#TxtId").val(id);
        $('#CargaGif').show();
        $.ajax({
            type: "POST",
            url: 'upd-gobusr.php',
            data: $("form#frmnvo").serialize(),
            success: function(data) {
                //$('#btnEnviar').removeAttr('disabled');
                $('#CargaGif').hide();
                $('#grid').DataTable().draw();
                $('#mdlnvo').modal('hide');
                alert('Usuario actualizado :)');
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false;
    });

    $(document).on('click', '#btnEliminar', function() {
        $('#CargaGif').show();
        $.ajax({
            type: "POST",
            url: 'del-gobusr.php',
            data: $("form#formulario").serialize(),
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
        return false;
    });

    $(document).on('click touchstart', '#grid tr', function() {
        if (timer == 0) {
            timer = 1;
            timer = setTimeout(function() {
                timer = 0;
            }, 600);
        } else {
            //$('#frmnvo').reset();
            id = $(this).attr("id");
            $("#TxtClave").val(id);
            $('#CargaGif').show();
            $.ajax({
                type: "POST",
                url: 'tabla-gobgrupoid.php',
                data: $("#TxtClave").serialize(),
                success: function(data) {
                    //$('#btnEnviar').removeAttr('disabled');
                    var res = JSON.parse(data);
                    $("#txtnombre").val(res[0].nombre);
                    $("#txtusuario").val(res[0].usuario);
                    $("#txtpass").val(res[0].contraseña);
                    $("#txttel").val(res[0].telefono);
                    $("#txtcorreo").val(res[0].Correo);
                    $("#txtpasscorreo").val(res[0].PassC);
                    $("#Cmbperfiles").val(res[0].Id_Perfil);
                    $("#Cmbgrupo").val(res[0].Id_Grupo);

                    $('#CargaGif').hide();
                    $('#mdlnvo').modal('show')
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false;
            timer = 0;
        }
    });
    $(document).on('click', '#grid tr', function() {
        id = $(this).attr("id");
        $("#TxtClave").val(id);
    });

</script>

</html>
