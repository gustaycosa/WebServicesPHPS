<!DOCTYPE html>
<html class="no-js">

<?php 
    include("../../funciones.php"); 
    $TituloPantalla = 'Panel de control de usuarios y accesos';
    echo Cabecera($TituloPantalla);    
?>
    
    <style>
        .modal-backdrop{background: #00000073 !important;}
    </style>
           

<body>
    <div class="panel panel-default row">
       <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
            <h6 id="cabecera">
                <?php echo $TituloPantalla; ?>
            </h6>
        </div>
        <div class="panel-body">
            <form id="formulario" method="POST" class="form-inline">
                <input type="hidden" id="TxtClave" name="TxtClave">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
                <button type="button" id="btnNuevo" class="btn btn-primary btn-sm" onMouseOver="" data-toggle="modal" data-target="#mdlnvo">Nuevo</button>
                <button type="button" id="btnEliminar" class="btn btn-primary btn-sm" onMouseOver="">Eliminar</button>
            </form>
            <div class="col-sm-8">
                <div class="panel panel-info">
                   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
                        <h3 class="panel-title" style="display:inline-block;">Usuarios</h3>
                        <button class="btn btn-primary btn-sm" style="float:right;">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                        <button class="btn btn-primary btn-sm" style="float:right;">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>
                        <button class="btn btn-primary btn-sm" style="float:right;">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                        <button class="btn btn-danger btn-sm" style="float:right;">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive row" style="margin-top: -21px !important;">
                            <table id='gridusers' class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                            </table>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-info">
                   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
                        <h3 class="panel-title">Accesos</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive row" style="margin-top: -21px !important;">
                            <table id='gridperfil'  class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                            </table>
                        </div> 
                    </div>
                </div>
                <div class="panel panel-info">
                   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
                        <h3 class="panel-title">Permisos</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive row" style="margin-top: -21px !important;">
                            <table id='gridperm'  class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
            
            <div class='modal' id='mdlnvo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden="true">
                <div class='modal-dialog modal-dialog-centered' role='document'>
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
                                        <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES"); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php echo CmbCualquieras('id_perfil','perfil','perfiles');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php echo CmbCualquieras('Id_Grupo','Grupo','Grupos');?>
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
                                        <button type="button" class="btn btn-primary col-sm-12" id="btnagregar">Crear usuario</button>
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
    });
    $(document).on('click', '#btnEnviar2', function() {
        $('#CargaGif').show();
        $('#btnEnviar').attr('disabled', 'disabled')
        $.ajax({
            type: "POST",
            url: 'con-selusuarios.php',
            data: $("form").serialize(),
            success: function(data) {
                $('#CargaGif').hide();
                var res = JSON.parse(data);
                $('#gridusers').dataTable().fnClearTable();
                $('#gridusers').dataTable().fnAddData(res);
                $('#gridusers').DataTable().draw();
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });


//    $(document).on('click', '#BtnNuevo', function() {
//        $("#TxtClave").val(id);
//        $('#CargaGif').show();
//        $.ajax({
//            type: "POST",
//            url: 'tabla-tallmaqusadadet.php',
//            data: $("form#frmnvo").serialize(),
//            success: function(data) {
//                //$('#btnEnviar').removeAttr('disabled');
//                $('#CargaGif').hide();
//                $("#DivMdlMaqDet").html(data); // Mostrar la respuestas del script PHP.
//                $("#DivMdlMaqDet").show();
//                $('#MdlMaqDet').modal('show')
//            },
//            error: function(error) {
//                $('#CargaGif').hide();
//                console.log(error);
//                alert('Algo salio mal :S');
//            }
//        });
//        return false;
//    });

    $(document).on('click', '#btnagregar', function() {
        $('#CargaGif').show();
        //$('#btnEnviar').attr('disabled', 'disabled')
        $.ajax({
            type: "POST",
            url: 'con-nvousuarios.php',
            data: $("form#frmnvo").serialize(),
            success: function(data) {
                $('#CargaGif').hide();
                $('#mdlnvo').modal('hide');
                alert('Usuario agregado :)');
                $('#grid').DataTable().draw();
                //$('#frmnvo').reset();
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
//        id c= $(this).attr("value");
//        $("#TxtClave").val(id);
        $('#CargaGif').show();
        $.ajax({
            type: "POST",
            url: 'con-delusuarios.php',
            data: $("form#formulario").serialize(),
            success: function(data) {
                //$('#btnEnviar').removeAttr('disabled');
                $('#CargaGif').hide();
                alert('Usuario eliminado :)');
                $('#CargaGif').show();
                $('#btnEnviar2').click();
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false;
    });

    $(document).on('click touchstart', '#gridusers tr', function() {
        $('#gridusers tr').removeClass('bg-success');
        $(this).addClass('bg-success');
        $('#CargaGif').show();
        id = $(this).attr("id");
        $("#TxtClave").val(id);
        if (timer == 0) {
            timer = 1;
            timer = setTimeout(function() {
                timer = 0;
            }, 600);
            getData1();
        } else {
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
                url: 'con-selpermisos.php',
                data: $("#TxtClave").serialize(),
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    $('#gridperm').dataTable().fnClearTable();
                    $('#gridperm').dataTable().fnAddData(res);
                    $('#gridperm').DataTable().draw();
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
                url: 'con-selperfil.php',
                data: $("#TxtClave").serialize(),
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    $('#gridperfil').dataTable().fnClearTable();
                    $('#gridperfil').dataTable().fnAddData(res);
                    $('#gridperfil').DataTable().draw();
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
    $(document).on('click', '#gridusers tr', function() {
        id = $(this).attr("id");
        $("#TxtClave").val(id);
    });
/*    
    $(document).ready(function() {
        $('#CargaGif').show();
        $('#btnEnviar').click();
    });*/
    
$(document).ready(function() {
var b = '';
            
    datos1 = [
        { data: "usuario", 'width':'20px'},
        { data: "nombre", 'width':'60px'},
        { data: "Perfil", 'width':'30px'},
        { data: "Grupo", 'width':'20px'},
        { data: "Estatus"},
        { data: "Fum" }
    ];
    cabeceras1 = [
        { "title": "usuario", 'width':'20px', className: "text-left", "targets": 0},
        { "title": "Nombre", 'width':'60px', className: "text-left", "targets": 1},
        { "title": "Perfil", 'width':'30px', className: "text-left", "targets": 2},
        { "title": "Grupo", 'width':'20px', className: "text-cener", "targets": 3},
        { "title": "Estatus", 'width':'60px', className: "text-right", "targets": 4,visible:false},
        { "title": "Fum", 'width':'60px', className: "text-left", "targets": 5,visible:false}
    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
                $(row).attr({ id:data.id});
            },
            dom: 'lfBrtip', 
            paging: false,
            searching: true,
            ordering: true,
            buttons: [
                {
                    extend: 'excel',
                    message: 'PDF creado desde el sistema en linea del tayco.',
                    text: 'XLS',
                    filename: '<?php echo "facturas_abono_".date('Y-m-d');?>',
                    extension: '.xlsx', 
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
            ],
            'pagingType': 'full_numbers',
            'lengthMenu': [[-1], ['Todo']],
            'language': {
                'sProcessing':    'Procesando...',
                'sLengthMenu':    'Mostrar _MENU_ registros',
                'sZeroRecords':   'No se encontraron resultados',
                'sEmptyTable':    'Ningún dato disponible en esta tabla',
                'sInfo':          'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                'sInfoEmpty':     'Mostrando registros del 0 al 0 de un total de 0 registros',
                'sInfoFiltered':  '(filtrado de un total de _MAX_ registros)',
                'sInfoPostFix':   '',
                'sSearch':        'Buscar:',
                'sUrl':           '',
                'sInfoThousands':  ',',
                'sLoadingRecords': 'Cargando...',
                'oPaginate': {
                    'sFirst':    'Primero',
                    'sLast':    'Último',
                    'sNext':    'Siguiente',
                    'sPrevious': 'Anterior'
                },
                'oAria': {
                    'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
                    'sSortDescending': ': Activar para ordenar la columna de manera descendente'
                }
            },
            'scrollY': '60vh',
            'scrollCollapse': true,
            'scrollX': true,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true
        }


    $('#txtbusqueda').on('keyup change', function() {
      //clear global search values
      table.search('');
      table.column().search(this.value).draw();
    });

    $(".dataTables_filter input").on('keyup change', function() {
      //clear column search values
      table.columns().search('');
      //clear input values
      $('#txtbusqueda').val('');
    });
    
    var table = $('#gridusers').DataTable(grid1);
    
    $('#CargaGif').show();
    $('#btnEnviar2').click();
    
    datos2 = [
        { data: "Descripcion" },
        { data: "Tipo" ,'width':'20px',},
        { data: "Modulo" },
    ];
    cabeceras2 = [
        { "title": "FORMA", 'width':'60px', className: "text-left", "targets": 0},
        { "title": "TIPO", 'width':'20px', className: "text-left", "targets": 1},
        { "title": "MODULO", 'width':'60px', className: "text-center", "targets": 2}
    ];
    var grid2 = {
            'columns': datos2,
            'columnDefs': cabeceras2,
            'createdRow': function (row,data,index){
                //$(row).attr({ id:data.id});
            },
            dom: 'lfBrtip', 
            paging: false,
            searching: true,
            ordering: true,
            buttons: [
                {
                    extend: 'excel',
                    message: 'PDF creado desde el sistema en linea del tayco.',
                    text: 'XLS',
                    filename: '<?php echo "facturas_abono_".date('Y-m-d');?>',
                    extension: '.xlsx', 
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
            ],
            'pagingType': 'full_numbers',
            'lengthMenu': [[-1], ['Todo']],
            'language': {
                'sProcessing':    'Procesando...',
                'sLengthMenu':    'Mostrar _MENU_ registros',
                'sZeroRecords':   'No se encontraron resultados',
                'sEmptyTable':    'Ningún dato disponible en esta tabla',
                'sInfo':          'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                'sInfoEmpty':     'Mostrando registros del 0 al 0 de un total de 0 registros',
                'sInfoFiltered':  '(filtrado de un total de _MAX_ registros)',
                'sInfoPostFix':   '',
                'sSearch':        'Buscar:',
                'sUrl':           '',
                'sInfoThousands':  ',',
                'sLoadingRecords': 'Cargando...',
                'oPaginate': {
                    'sFirst':    'Primero',
                    'sLast':    'Último',
                    'sNext':    'Siguiente',
                    'sPrevious': 'Anterior'
                },
                'oAria': {
                    'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
                    'sSortDescending': ': Activar para ordenar la columna de manera descendente'
                }
            },
            'scrollY': '25vh',
            'scrollCollapse': true,
            'scrollX': true,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true
        }
    var table2 = $('#gridperfil').DataTable(grid2);
    
    
    datos3 = [
        { data: "TipoPermiso" }
    ];
    cabeceras3 = [
        { "title": "PERMISO", 'width':'60px', className: "text-left", "targets": 0}
    ];
    var grid3 = {
            'columns': datos3,
            'columnDefs': cabeceras3,
            'createdRow': function (row,data,index){
                //$(row).attr({ id:data.id});
                if( ! table3.data().any()){   
                    $('#gridperm').dataTable().fnClearTable();
                }
                else{

                }
            },
            dom: 'lfBrtip', 
            paging: false,
            searching: true,
            ordering: true,
            buttons: [
                {
                    extend: 'excel',
                    message: 'PDF creado desde el sistema en linea del tayco.',
                    text: 'XLS',
                    filename: '<?php echo "facturas_abono_".date('Y-m-d');?>',
                    extension: '.xlsx', 
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
            ],
            'pagingType': 'full_numbers',
            'lengthMenu': [[-1], ['Todo']],
            'language': {
                'sProcessing':    'Procesando...',
                'sLengthMenu':    'Mostrar _MENU_ registros',
                'sZeroRecords':   'No se encontraron resultados',
                'sEmptyTable':    'Ningún dato disponible en esta tabla',
                'sInfo':          'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                'sInfoEmpty':     'Mostrando registros del 0 al 0 de un total de 0 registros',
                'sInfoFiltered':  '(filtrado de un total de _MAX_ registros)',
                'sInfoPostFix':   '',
                'sSearch':        'Buscar:',
                'sUrl':           '',
                'sInfoThousands':  ',',
                'sLoadingRecords': 'Cargando...',
                'oPaginate': {
                    'sFirst':    'Primero',
                    'sLast':    'Último',
                    'sNext':    'Siguiente',
                    'sPrevious': 'Anterior'
                },
                'oAria': {
                    'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
                    'sSortDescending': ': Activar para ordenar la columna de manera descendente'
                }
            },
            'scrollY': '20vh',
            'scrollCollapse': true,
            'scrollX': true,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true
        }
    $.fn.dataTable.ext.errMode = 'none';
    var table3 = $('#gridperm').DataTable(grid3);
    
    $(document).on('click', '#btnEnviar2', function(e) {
            e.preventDefault();
            $('#CargaGif').show();
            event.preventDefault();
            //$('#btnEnviar').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: 'con-selusuarios.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    $('#gridusers').dataTable().fnClearTable();
                    $('#gridusers').dataTable().fnAddData(res);
                    $('#gridusers').DataTable().draw();
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

</script>

</html>
