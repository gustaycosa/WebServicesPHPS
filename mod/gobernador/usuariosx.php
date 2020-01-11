<?php include("validasesion.php"); ?>
<!DOCTYPE html>
<html class="no-js">

<?php 
    include("../../funciones.php"); 
    $TituloPantalla = 'Panel de control de usuarios y accesos';
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
            <div class="col-sm-6">
                <div class="panel panel-primary">
                   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
                        <h3 class="panel-title">Usuarios</h3>
                    </div>
                    <div class="panel-body">
                        <div class="respuesta">
                        <div class='table-responsive'>
                            <table id='grid' class='table table-striped table-bordered table-condensed table-hover compact' cellspacing='0' style='width:100%;' ></table></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
                        <h3 class="panel-title">Accesos</h3>
                    </div>
                    <div class="panel-body">
                        <div class="respuesta"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-info">
                   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
                        <h3 class="panel-title">Permisos</h3>
                    </div>
                    <div class="panel-body">
                        <div class="respuesta"></div>
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
            <div class='modal bs-example-modal-sm' id='mdlnvo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                <div class='modal-dialog modal-sm' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <h4 class='modal-title' id='myModalLabel'>Agregar usuario</h4>
                        </div>
                        <div id='mdldivnvo' class='modal-body'>
                            <form id="frmnvo" class="form-horizontal" method="POST">
                                <input type="hidden" id="TxtId" name="TxtId">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="txtnombre" class="form-control" id="txtnombre" placeholder="Nombre y apellidos">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="txtusuario" class="form-control" id="txtusuario" placeholder="Nombre de usuario">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="password" name="txtpass" class="form-control" id="txtpass" placeholder="Contraseña">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php echo CmbCualquieras('id_perfil','perfil','perfiles');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php echo CmbCualquieras('Id_Grupo','grupo','grupo');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="txttel" class="form-control" id="txttel" placeholder="Numero telefonico">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="txtcorreo" class="form-control" id="txtcorreo" placeholder="Correo electronico">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="txtpasscorreo" class="form-control" id="txtpasscorreo" placeholder="Contraseña correo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary col-sm-12" id="btnagregar">Crear usuario</button>
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
    var res1;
    
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
                    var res1 = JSON.parse(data);
                    $('#CargaGif').hide();
                    $('#btnEnviar').removeAttr('disabled');
/*                    $(".respuesta").html(data); // Mostrar la respuestas del script PHP.
                    $(".respuesta").show();*/
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
    });
    $(document).on('click', '#grid tr', function() {
        id = $(this).attr("id");
        $("#TxtClave").val(id);
    });
    $(document).ready(function() {
        $('#CargaGif').show();
        $('#btnEnviar').click();

        $(document).ready(function() {
            var table = $('#grid').DataTable({
                data: res1,
                columns: [{
                        data: 'usuario'
                    },
                    {
                        data: 'nombre'
                    },
                    {
                        data: 'Perfil'
                    },
                    {
                        data: 'Grupo'
                    },
                ],
                columnDefs: [{
                        'title': 'USUARIO',
                        'width': '70px',
                        className: "text-left",
                        'targets': 0
                    },
                    {
                        'title': 'NOMBRE',
                        'width': '70px',
                        className: "text-left",
                        'targets': 1
                    },
                    {
                        'title': 'PERFIL',
                        'width': '70px',
                        className: "text-left",
                        'targets': 2
                    },
                    {
                        'title': 'GRUPO',
                        'width': '70px',
                        className: "text-left",
                        'targets': 3
                    },
                ],
                'createdRow': function(row, data, index) {
                    $(row).attr({
                        id: data.id
                    });
                    //$(row).addClass('mec');
                },
                dom: 'lfBrtip',
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
                            // Splice the image in after the header, but before the table
                            doc.content.splice(1, 0, {

                                alignment: 'center'
                            });
                            // Data URL generated by http://dataurl.net/#dataurlmaker
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
                'scrollY': '60vh',
                'scrollX': 'true',
                'scrollCollapse': true,
                'paging': false
            });
            $('#txtbusqueda').on('keyup change', function() {
                //clear global search values
                table.search('');
                table.column($(this).data('columnIndex')).search(this.value).draw();
            });

            $(".dataTables_filter input").on('keyup change', function() {
                //clear column search values
                table.columns().search('');
                //clear input values
                $('#txtbusqueda').val('');
            });
        });

    });

</script>

</html>
