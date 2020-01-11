<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("funciones.php"); ?>
<head>
<title id="title"></title>
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
            <div class='table-responsive'>
                <table id='griddet' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;">
                    <thead>
                        <tr>
                            <td></td><td></td><td></td><td></td><td></td>
                        </tr>
                    </thead>
                </table>
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

<script type="text/javascript">
    var timer = 0;
    $(function() {
        <?php echo JqueryButtons();?>
    });
    
    $(function() {           
        $("form").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'tabla-edoresultados.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    $('#grid').dataTable().fnClearTable();
                    $('#grid').dataTable().fnAddData(res);
                    $('#grid').DataTable().draw();
                },
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

    $('select#TxtMes').on('change', function() {
        var id = $('#TxtEjercicio').val();
        var name = $('#TxtMes option:selected').html();
        $("#title").html("Reporte ventas - CLAVE " + id + " - " + name);
        $("#cabecera").html("REPORTE DE ESTADOS - PERIODO " + name + " - " + id);
    });

    $(document).on('click touchstart', '#grid tbody tr', function() {

        var id = $(this).attr("id");
        //alert(id);
        $("#TxtClave").val(id);

        if (timer == 0) {
            timer = 1;
            timer = setTimeout(function() {
                timer = 0;
            }, 600);
        } else {
            //alert("double tap"); 
            var id = $(this).parent().attr("id");
            $("#TxtClave").val(id);
            $('#CargaGif').show();
            //$("#myModalLabel").text('FACTURADO '+id);
            $.ajax({
                type: "POST",
                url: 'tabla-edoresultados2.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    //$('#btnEnviar').removeAttr('disabled');
                    $('#CargaGif').hide();
                    $(".detalle").html(data); // Mostrar la respuestas del script PHP.
                    $(".detalle").show();
                    //$('#MdlMaqDet').modal('show')
                    $('#gridfact').DataTable().draw();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false; // Evitar ejecutar el submit del formulario.
            timer = 0;
        }
    });
    $(document).ready(function() {
/*
        datos1 = [
            //{ data: "ConceptoCtb" },
            { data: "Mes_Actual" },
            { data: "Mes_Anterior" },
            { data: "Acumulado_Act" },
            { data: "Acumulado_Ant" },
        ];
        cabeceras1 = [
            //{ 'title': 'CONCEPTO', className: "text-left", 'targets': 0},
            { 'title': 'MES ACTUAL', 'width': '120px', className: "text-right", 'targets': 0},
            { 'title': 'MES ANTERIOR', 'width': '120px', className: "text-right", 'targets': 2},
            { 'title': 'ACUM.MES ACTUAL', 'width': '120px', className: "text-right", 'targets': 3},
            { 'title': 'ACUM.MES ANT.', 'width': '120px', className: "text-right", 'targets': 4}
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


        };*/
        var table = $('#grid').DataTable();
        
        //////////////////////////////////////////////////////////////////////////////////////
/*        $('#txtbusqueda').on('keyup change', function() {
          //clear global search values
          table.search('');
          table.column($(this).data('columnIndex')).search(this.value).draw();
        });

        $(".dataTables_filter input").on('keyup change', function() {
          //clear column search values
          table.columns().search('');
          //clear input values
          $('#txtbusqueda').val('');
        });*/
   
    });

</script>

</html>
