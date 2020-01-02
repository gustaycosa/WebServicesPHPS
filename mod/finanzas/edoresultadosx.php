<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<head>
<title id="title"></title>
    <meta charset=utf-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="TAYCO SA DE CV" />
    <link rel="stylesheet" type="text/css" href="../../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css"  />
    <link rel="stylesheet" type="text/css" href="../../css/ThemeBlue.css"  />
    <link rel="stylesheet" type="text/css" href="../../css/CargaGif.css"  />
</head>
<body>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 id="cabecera">
            Estado de resultados
        </h6>
    </div>
    <div class="panel-body">
        <form id="formulario" method="POST" class="form-inline">
            <div class="form-group">
                <?php echo TxtPeriodo();?>
            </div>
            <div class="form-group">
                <?php echo CmbMes();?>
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="" placeholder="Ingrese ejercicio">
            </div>
            <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
        </form>
        <div class="respuesta">
            <table id='grid' class='table table-bordered table-condensed table-hover display compact' style="width:100%;"></table>
        </div>                
        <div class="form-inline">
            <div class="modal-footer col-sm-2">
                <?php echo BusquedaGrid(0,'nombre');?>
            </div>
            <div class="modal-footer col-sm-10">
                <?php echo HtmlButtons();?>
            </div>
        </div>
        <?php echo CargaGif();?>
    </div>
</div>
</body>

<script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../js/popper.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js" ></script>
<link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="../../js/jeditable.min.js" ></script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="../../js/dataTables.bootstrap.min.js" ></script>
<script type="text/javascript" src="../../js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../../js/buttons.flash.min.js"></script>
<script type="text/javascript" src="../../js/jszip.min.js"></script>
<script type="text/javascript" src="../../js/buttons.print.min.js"></script>
    
<script type="text/javascript">
var timer = 0;
var id = 0;
    
        $(function() {        
            <?php echo JqueryButtons();?>   
        });
        $(function() {
            $("form").on('submit', function(e) {
                $('#CargaGif').show();
                $('#btnEnviar').attr('disabled');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'con-edoresultados.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        $('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        var res = JSON.parse(data);
                        $('#grid').dataTable().fnClearTable();
                        $('#grid').dataTable().fnAddData(res);
                        $('#grid').DataTable().draw();
                    },
                    error: function(error) {
                        ('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        console.log(error);
                        alert('Algo salio mal :S');
                    }
                });

                return false; // Evitar ejecutar el submit del formulario.
            });
        });
        $(document).on('click','td.autok',function(){
            var id = $(this).parent().attr("id");
            var mov = $(this).parent().attr("mov");
            $("#TxtRow").val(id);
            $("#TxtMov").val(mov);
            $('#CargaGif').show();
            $.ajax({
                type: "POST",
                url: 'nvo-autok.php',
                data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    //$('#btnEnviar').removeAttr('disabled');
                    $('#CargaGif').hide();
                    alert('Autorizacion exitosa');
                    $('#btnEnviar2').click();
                    //$('#gridcom').DataTable().draw();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false; // Evitar ejecutar el submit del formulario.	
        });        
        
        $(document).on('click','td.autcn',function(){
            var id = $(this).parent().attr("id");
            var mov = $(this).parent().attr("mov");
            $("#TxtRow").val(id);
            $("#TxtMov").val(mov);
            $('#CargaGif').show();
            $.ajax({
                type: "POST",
                url: 'nvo-autcn.php',
                data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    //$('#btnEnviar').removeAttr('disabled');
                    $('#CargaGif').hide();
                    alert('Autorizacion exitosa');
                    $('#btnEnviar2').click();
                    //$('#gridcom').DataTable().draw();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false; // Evitar ejecutar el submit del formulario.	
        }); 
    
$(document).ready(function() {

    datos1 = [
//        { data: "ConceptoCtb" },
//        { data: "Mes_Actual" },
//        { data: "Mes_Anterior" },
//        { data: "Acumulado_Act" },
//        { data: "Acumulado_Ant" }
//        { data: "id_cuentactb" },
        { data: "id_mayor", 'width':'60px'},
//        { data: "tipocuenta" },
        { data: "nombre", 'width':'280px' },
//        { data: "naturaleza" },
        { data: "saldo_ene", 'width':'60px' },
        { data: "saldo_feb", 'width':'60px' },
        { data: "saldo_mar", 'width':'60px' },
        { data: "saldo_abr", 'width':'60px' },
        { data: "saldo_may", 'width':'60px' },
        { data: "saldo_jun", 'width':'60px' },
        { data: "saldo_jul", 'width':'60px' },
        { data: "saldo_ago", 'width':'60px' },
        { data: "saldo_sep", 'width':'60px' },
        { data: "saldo_oct", 'width':'60px' },
        { data: "saldo_nov", 'width':'60px' },
        { data: "saldo_dic", 'width':'60px' }
    ];
    cabeceras1 = [
//        { "title": "CONCEPTO CONTABLE", 'width':'60px', className: "text-left", "targets": 0},
//        { "title": "MES ACTUAL", 'width':'60px', className: "text-left", "targets": 1},
//        { "title": "MES ANTERIOR", 'width':'60px', className: "text-left", "targets": 2},
//        { "title": "ACUMULADO ACTUAL", 'width':'150px', className: "text-left", "targets": 3},
//        { "title": "ACUMULADO ANTERIOR", 'width':'60px', className: "text-left", "targets": 4}
//        { "title": "CUENTA", 'width':'60px', className: "text-left", "targets": 0},
        { "title": "MAYOR", 'width':'60px', className: "text-left", "targets": 0},
//        { "title": "TIPO", 'width':'60px', className: "text-left", "targets": 2},
        { "title": "NOMBRE", 'width':'60px', className: "text-left", "targets": 1},
//        { "title": "NAT", 'width':'60px', className: "text-left", "targets": 4},
        { "title": "ENERO", 'width':'180px', className: "text-right", "targets": 2},
        { "title": "FEBRERO", 'width':'60px', className: "text-right", "targets": 3},
        { "title": "MARZO", 'width':'60px', className: "text-right", "targets": 4},
        { "title": "ABRIL", 'width':'60px', className: "text-right", "targets": 5},
        { "title": "MAYO", 'width':'60px', className: "text-right", "targets": 6},
        { "title": "JUNIO", 'width':'60px', className: "text-right", "targets": 7},
        { "title": "JULIO", 'width':'60px', className: "text-right", "targets": 8},
        { "title": "AGOSTO", 'width':'60px', className: "text-right", "targets": 9},
        { "title": "SEPTIEMBRE", 'width':'60px', className: "text-right", "targets": 10},
        { "title": "OCTUBRE", 'width':'60px', className: "text-right", "targets": 11},
        { "title": "NOVIEMBRE", 'width':'60px', className: "text-right", "targets": 12},
        { "title": "DICIEMBRE", 'width':'60px', className: "text-right", "targets": 13}
    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            dom: 'lfBrtip', 
            paging: false,
            searching: true,
            ordering: true,
            buttons: [
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
            'scrollX': false,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true
    }; 

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
    var table = $('#grid').DataTable(grid1);


});
</script>
</html>
