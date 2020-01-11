<?php 
    include("../../funciones.php");  
?>
<!DOCTYPE html>
<html class="no-js">

<?php echo Cabecera('Reporte de edos. flujos de efectivo'); ?>
<?php
    $TituloPantalla = 'Reporte de edos. flujo de efectivo';    
?>

<body>
    <div class="panel panel-default">
       <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
            <h6 id="cabecera">
                Registro de operaciones
            </h6>
        </div>
        <div class="panel-body">
            <form id="formulario" method="POST" class="form-inline">
                <input type="hidden" id="TxtClave" name="TxtClave">
                <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
                <button type="button" id="btnNuevo" class="btn btn-primary btn-sm" onMouseOver="" data-toggle="modal" data-target="#mdlnvo">Nuevo</button>
                <button type="button" id="btnEliminar" class="btn btn-primary btn-sm" onMouseOver="">Eliminar</button>
            </form>
            <div class="col-sm-12">
                <div class="panel panel-primary">
                   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
                        <h3 class="panel-title">Registros</h3>
                    </div>
                    <div class="panel-body">
                        <table id="grid" class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                </tr>
                            </thead>
                              <!--                          <thead>
                                <tr>
                                    <th>FECHA</th>
                                    <th>ESTABLO</th>
                                    <th>PROCEDENCIA</th>
                                    <th>PRODUCTO</th>
                                    <th>FICHA</th>
                                    <th>PESO</th>
                                    <th>PRECIO</th>
                                    <th>CHOFER</th>
                                    <th>FACTURA #</th>
                                    <th>FACTURA DE</th>
                                    <th>FACTURA</th>
                                    <th>PAGADA</th>
                                    <th>MANO OBRA</th>
                                    <th>PAGO MO COMISION</th>
                                    <th>COMISION PAGADA</th>
                                    <th>COYOTE</th>
                                </tr>
                            </thead>-->
                            <tbody>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                                <tr>
                                    <td>17/09/18</td>
                                    <td>TREBOL</td>
                                    <td>OMAR SOTO</td>
                                    <td>SEGUNDAS</td>
                                    <td>1862</td>
                                    <td>30190</td>
                                    <td>$2.40</td>
                                    <td>ALONSO RIOS</td>
                                    <td>620</td>
                                    <td>SILVIA</td>
                                    <td>PENDIENTE</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>SI</td>
                                    <td>CUCO</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="form-inline col-sm-12">
                <div class="modal-footer col-sm-2">
                    <?php echo BusquedaGrid(0,'nombre');?>
                </div>
                <div class="modal-footer col-sm-10">
                    <?php echo HtmlButtons();?>
                </div>
            </div>
            <div class='modal bs-example-modal-lg' id='mdlnvo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                <div class='modal-dialog modal-lg' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <h4 class='modal-title' id='myModalLabel'>Agregar registro</h4>
                        </div>
                        <div id='mdldivnvo' class='modal-body'>
                            <form id="frmnvo" class="form-horizontal" method="POST">
                                <input type="hidden" id="TxtId" name="TxtId">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtnombre" class="form-control" id="txtnombre" placeholder="Fecha">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtnombre" class="form-control" id="txtnombre" placeholder="Establo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtusuario" class="form-control" id="txtusuario" placeholder="Procedencia">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtpass" class="form-control" id="txtpass" placeholder="Chofer">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtpass" class="form-control" id="txtpass" placeholder="Producto">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txttel" class="form-control" id="txttel" placeholder="Peso">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtpass" class="form-control" id="txtpass" placeholder="Ficha">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txttel" class="form-control" id="txttel" placeholder="Precio">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtcorreo" class="form-control" id="txtcorreo" placeholder="Factura">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtpass" class="form-control" id="txtpass" placeholder="Factura de">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txttel" class="form-control" id="txttel" placeholder="Pagada">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtcorreo" class="form-control" id="txtcorreo" placeholder="MO">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txttel" class="form-control" id="txttel" placeholder="Pago de MO">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtcorreo" class="form-control" id="txtcorreo" placeholder="Comision">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="txtcorreo" class="form-control" id="txtcorreo" placeholder="Comision pagada">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="txtcorreo" class="form-control" id="txtcorreo" placeholder="Coyote">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary col-sm-12" id="btnagregar">Crear registro</button>
                                        <button type="submit" class="btn btn-primary col-sm-12" id="btnactualizar">Actualizar registro</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                url: 'tabla-gobusr.php',
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
        //$('#frmnvo').reset();
        id = $(this).attr("id");
        $("#TxtClave").val(id);
        if (timer == 0) {
            timer = 1;
            timer = setTimeout(function() {
                timer = 0;
            }, 600);
            getData1();
        } else {
            $('#CargaGif').show();
            $.ajax({
                type: "POST",
                url: 'tabla-gobusrid.php',
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

        function getData2() {
            $.ajax({
                type: "POST",
                url: 'tabla-gobpermisos.php',
                data: $("#TxtClave").serialize(),
                success: function(data) {
                    $('#CargaGif').hide();
                    $('#btnEnviar').removeAttr('disabled');
                    $(".permisos").html(data); // Mostrar la respuestas del script PHP.
                    $(".permisos").show();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false;
        }

        function getData1() {
            $.ajax({
                type: "POST",
                url: 'tabla-gobaccesos.php',
                data: $("#TxtClave").serialize(),
                success: function(data) {
                    $('#CargaGif').hide();
                    $('#btnEnviar').removeAttr('disabled');
                    $(".accesos").html(data); // Mostrar la respuestas del script PHP.
                    $(".accesos").show();
                    getData2();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false;
        }
    });
    $(document).on('click', '#grid tr', function() {
        id = $(this).attr("id");
        $("#TxtClave").val(id);
    });
    $(document).ready(function() {
        //        $('#CargaGif').show();
        //        $('#btnEnviar').click();

        cabeceras1 = [{
                "title": "FECHA",
                'width': '60px',
                className: "text-left",
                "targets": 0
            },
            {
                "title": "ESTABLO",
                'width': '60px',
                className: "text-right",
                "targets": 1
            },
            {
                "title": "PROCEDENCIA",
                'width': '100px',
                className: "text-right",
                "targets": 2
            },
            {
                "title": "PRODUCTO",
                'width': '60px',
                className: "text-left",
                "targets": 3
            },
            {
                "title": "FICHA",
                'width': '60px',
                className: "text-right",
                "targets": 4
            },
            {
                "title": "PESO",
                'width': '60px',
                className: "text-right",
                "targets": 5
            },
            {
                "title": "PRECIO",
                'width': '60px',
                className: "text-left",
                "targets": 6
            },
            {
                "title": "CHOFER",
                'width': '60px',
                className: "text-right",
                "targets": 7
            },
            {
                "title": "FACTURA",
                'width': '60px',
                className: "text-right",
                "targets": 8
            },
            {
                "title": "FACTURA DE",
                'width': '60px',
                className: "text-left",
                "targets": 9
            },
            {
                "title": "FACTURA PAGADA",
                'width': '60px',
                className: "text-right",
                "targets": 10
            },
            {
                "title": "MANO OBRA",
                'width': '60px',
                className: "text-right",
                "targets": 11
            },
            {
                "title": "PAGO MO",
                'width': '60px',
                className: "text-left",
                "targets": 12
            },
            {
                "title": "COMISION",
                'width': '60px',
                className: "text-right",
                "targets": 13
            },
            {
                "title": "COMISION PAGADA",
                'width': '60px',
                className: "text-right",
                "targets": 14
            },
            {
                "title": "COYOTE",
                'width': '60px',
                className: "text-left",
                "targets": 15
            }
        ];
        var grid1 = {
            'columnDefs': cabeceras1,
            dom: 'fBrt',
            paging: false,
            searching: true,
            ordering: true,
            buttons: [{
                    extend: 'copy',
                    message: 'PDF created by PDFMake with Buttons for DataTables.',
                    text: 'Copiar',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    customize: function(doc) {
                        doc.content.splice(1, 0, {
                            alignment: 'center'
                        });
                    },
                    filename: 'vtas_netasfact',
                    extension: '.pdf',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    header: 'true',
                    filename: 'vtas_netasfact',
                    extension: '.csv',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'excel',
                    message: 'PDF creado desde el sistema en linea del tayco.',
                    text: 'XLS',
                    filename: 'vtas_netasfact',
                    extension: '.xlsx',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        }
                    },
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('row:first c', sheet).attr('s', '42');
                    }
                },
                {
                    extend: 'print',
                    message: 'PDF creado desde el sistema en linea del tayco.',
                    text: 'Imprimir',
                    exportOptions: {
                        stripHtml: false,
                        modifier: {
                            page: 'all'
                        }
                    }
                },
            ],
            'pagingType': 'full_numbers',
            'lengthMenu': [
                [-1],
                ['Todo']
            ],
            'language': {
                'sProcessing': 'Procesando...',
                'sLengthMenu': 'Mostrar _MENU_ registros',
                'sZeroRecords': 'No se encontraron resultados',
                'sEmptyTable': 'Ningún dato disponible en esta tabla',
                'sInfo': 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
                'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
                'sInfoPostFix': '',
                'sSearch': 'Buscar:',
                'sUrl': '',
                'sInfoThousands': ',',
                'sLoadingRecords': 'Cargando...',
                'oPaginate': {
                    'sFirst': 'Primero',
                    'sLast': 'Último',
                    'sNext': 'Siguiente',
                    'sPrevious': 'Anterior'
                },
                'oAria': {
                    'sSortAscending': ': Activar para ordenar la columna de manera ascendente',
                    'sSortDescending': ': Activar para ordenar la columna de manera descendente'
                }
            },
            'scrollY': '30vh',
            'scrollCollapse': true,
            'scrollX': true,
            'paging': false,
            fixedHeader: {
                header: true,
                footer: false
            },
            'responsive': true


        };
        var table = $('#grid').DataTable(grid1);
        //////////////////////////////////////////////////////////////////////////////////////
    });

</script>

</html>
