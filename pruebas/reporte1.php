<!DOCTYPE html>
<html class="no-js">
<?php include("funciones.php"); ?>
<head>
<title id="title">Reporte Facturas Abono</title>
    <meta charset=utf-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="TAYCO SA DE CV" />
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
    <link rel="stylesheet" type="text/css" href="css/ThemeBlue.css"  />
    <link rel="stylesheet" type="text/css" href="css/CargaGif.css"  />
</head>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            Reporte Facturas Abono
        </h6>
    </div>
    <div class="panel-body">
        <form id="formulario" method="POST" class="form-inline">

            <div class="form-group">
                <label for="inputtext3" class="col-sm-3 control-label">Sucursal:</label>
                <div class="col-sm-9 ">
                    <?php include('http://ws.eimportacion.com.mx/cmb.php'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo TxtDateRango(); ?>
            </div>
            <div class="form-group">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
            </div>

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

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js" ></script>
<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="js/jeditable.min.js" ></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js" ></script>
<script type="text/javascript" src="js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="js/buttons.flash.min.js"></script>
<script type="text/javascript" src="js/jszip.min.js"></script>
<script type="text/javascript" src="js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>

    
<script type="text/javascript">
var timer = 0;
var id = 0;
    
        $(function() {        
            <?php echo JqueryButtons();?>   
        });
        $(function() {
//            $("form").on('submit', function(e) {
//                e.preventDefault();
//                $.ajax({
//                    type: "POST",
//                    url: 'con-reporte1.php',
//                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
//                    success: function(data) {
//                        $('#CargaGif').hide();
//                        var res = JSON.parse(data);
//                        $('#grid').dataTable().fnClearTable();
//                        $('#grid').dataTable().fnAddData(res);
//                        $('#grid').DataTable().draw();
//                    },
//                    error: function(error) {
//                        $('#CargaGif').hide();
//                        console.log(error);
//                        alert('Algo salio mal :S');
//                    }
//                });
//
//                return false; // Evitar ejecutar el submit del formulario.
//            });
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
        { data: "id_cliente" },
        { data: "Nombre" },
        { data: "tipodoc" },
        { data: "cve_documento" },
        { data: "fecha" },
        { data: "fechavence" },
        { data: "total" },
        { data: "Pendiente" },
        { data: "cve_aplico" },
        { data: "Documento" },
        { data: "totalPago" },
        { data: "remanente" }
    ];
    cabeceras1 = [
        { "title": "ID", 'width':'60px', className: "text-left", "targets": 0},
        { "title": "NOMBRE", 'width':'150px', className: "text-left", "targets": 1},
        { "title": "TIPO DOC.", 'width':'60px', className: "text-left", "targets": 2},
        { "title": "CLAVE DOC.", 'width':'60px', className: "text-left", "targets": 3},
        { "title": "FECHA", 'width':'60px', className: "text-left", "targets": 4},
        { "title": "VENCE", 'width':'60px', className: "text-right", "targets": 5},
        { "title": "tOTAL", 'width':'60px', className: "text-left", "targets": 6},
        { "title": "PENDIENTE", 'width':'60px', className: "text-right", "targets": 7},
        { "title": "APLICO", 'width':'60px', className: "text-left", "targets": 8},
        { "title": "DOCUMENTO", 'width':'60px', className: "text-left", "targets": 9},
        { "title": "TOTAL PAGO", 'width':'60px', className: "text-right", "targets": 10},
        { "title": "REMANENTE", 'width':'60px', className: "text-left", "targets": 11}

    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
                //$(row).attr({ id:data.id_cliente});
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

    //$('#CargaGif').show();
    //$('#btnEnviar2').click();
    $(document).on('click', '#btnEnviar2', function(e) {
            e.preventDefault();
            $('#CargaGif').show();
            event.preventDefault();
            //$('#btnEnviar').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: 'con-reporte1.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    $('#grid').dataTable().fnClearTable();
                    $('#grid').dataTable().fnAddData(res);
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
});
</script>
</html>
