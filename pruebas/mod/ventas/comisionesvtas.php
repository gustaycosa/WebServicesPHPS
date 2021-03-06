<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<head>
<title id="title">COMISIONES VENTAS</title>
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
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            Trayectoria de facturas
        </h6>
    </div>
    <div class="panel-body">
        <form id="formulario" method="POST" class="form-inline">

            <div class="form-group">
                <label for="inputtext3" class="col-sm-3 control-label">Sucursal:</label>
                <div class="col-sm-9 ">
                    <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES"); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo TxtDateRango(); ?>
            </div>
            <div class="form-group">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
            </div>

        </form>
        <div class="table-responsive">
            <h3>Vendedores</h3>
            <table id='grid'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <thead>
                    <tr>
                        <th>VENDEDOR</th>
                        <th>FACTURA</th>
                        <th>CLIENTE</th>
                        <th>DESCRIPCION</th>
                        <th>ESTATUS</th>
                        <th>TIPO</th>
                        <th>TOTAL</th>
                        <th>COMISION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <TD>JOSE SANTOS</TD>
                        <TD>C010233D02329</TD>
                        <TD>POMAS</TD>
                        <TD>ACEITES CUBETAS 20DWL</TD>
                        <TD>PAGADO</TD>
                        <TD>7 dias</TD>
                        <TD>$100000.00</TD>
                        <TD>$3000.00</TD>
                    </tr>
                    <tr>
                        <TD>JOSE SANTOS</TD>
                        <TD>C010233D02329</TD>
                        <TD>POMAS</TD>
                        <TD>ACEITES CUBETAS 20DWL</TD>
                        <TD>PAGADO</TD>
                        <TD>7 dias</TD>
                        <TD>$100000.00</TD>
                        <TD>$3000.00</TD>
                    </tr>
                    <tr>
                        <TD>JOSE SANTOS</TD>
                        <TD>C010233D02329</TD>
                        <TD>POMAS</TD>
                        <TD>ACEITES CUBETAS 20DWL</TD>
                        <TD>PAGADO</TD>
                        <TD>7 dias</TD>
                        <TD>$100000.00</TD>
                        <TD>$3000.00</TD>
                    </tr>
                    <tr>
                        <TD>JOSE JOSE</TD>
                        <TD>C010233D02329</TD>
                        <TD>POMAS</TD>
                        <TD>12 TOTEM TEXACO 20DWL</TD>
                        <TD>PAGADO</TD>
                        <TD>15 dias</TD>
                        <TD>$50000.00</TD>
                        <TD>$800.00</TD>
                    </tr>
                    <tr class="bg-danger">
                        <TD>JOSE LUIS</TD>
                        <TD>C010221702329</TD>
                        <TD>POMAS</TD>
                        <TD>FILTROS DONALDSON X50</TD>
                        <TD>SIN COBRAR</TD>
                        <TD>0 dias</TD>
                        <TD>$20000.00</TD>
                        <TD>$0.00</TD>
                    </tr>
                    <tr>
                        <TD>JOSE JOSE</TD>
                        <TD>C010233D02329</TD>
                        <TD>POMAS</TD>
                        <TD>12 TOTEM TEXACO 20DWL</TD>
                        <TD>PAGADO</TD>
                        <TD>30 dias</TD>
                        <TD>$50000.00</TD>
                        <TD>$400.00</TD>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                       <th></th><th></th><th></th><th></th><th></th><th></th><th>$370000.00</th><th>$10200.00</th>
                    </tr>
                </tfoot>
            </table>
        </div>      
        <h3>Vendedor</h3>
        <div class="table-responsive">
            <table id='grid2'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <thead>
                    <tr>
                        <th>FACTURA</th>
                        <th>CLIENTE</th>
                        <th>DESCRIPCION</th>
                        <th>ESTATUS</th>
                        <th>TIPO</th>
                        <th>TOTAL</th>
                        <th>COMISION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <TD>C010233D02329</TD>
                        <TD>POMAS</TD>
                        <TD>ACEITES CUBETAS 20DWL</TD>
                        <TD>PAGADO</TD>
                        <TD>7 dias</TD>
                        <TD>$100000.00</TD>
                        <TD>$3000.00</TD>
                    </tr>
                    <tr>
                        <TD>C010233D02329</TD>
                        <TD>POMAS</TD>
                        <TD>ACEITES CUBETAS 20DWL</TD>
                        <TD>PAGADO</TD>
                        <TD>7 dias</TD>
                        <TD>$100000.00</TD>
                        <TD>$3000.00</TD>
                    </tr>
                    <tr>
                        <TD>C010233D02329</TD>
                        <TD>POMAS</TD>
                        <TD>ACEITES CUBETAS 20DWL</TD>
                        <TD>PAGADO</TD>
                        <TD>7 dias</TD>
                        <TD>$100000.00</TD>
                        <TD>$3000.00</TD>
                    </tr>
                    <tr>
                        <TD>C010233D02329</TD>
                        <TD>POMAS</TD>
                        <TD>12 TOTEM TEXACO 20DWL</TD>
                        <TD>PAGADO</TD>
                        <TD>15 dias</TD>
                        <TD>$50000.00</TD>
                        <TD>$800.00</TD>
                    </tr>
                    <tr class="bg-danger">
                        <TD>C010221702329</TD>
                        <TD>POMAS</TD>
                        <TD>FILTROS DONALDSON X50</TD>
                        <TD>SIN COBRAR</TD>
                        <TD>0 dias</TD>
                        <TD>$0.00</TD>
                        <TD>$0.00</TD>
                    </tr>
                    <tr>
                        <TD>C010233D02329</TD>
                        <TD>POMAS</TD>
                        <TD>12 TOTEM TEXACO 20DWL</TD>
                        <TD>PAGADO</TD>
                        <TD>30 dias</TD>
                        <TD>$50000.00</TD>
                        <TD>$400.00</TD>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                       <th></th><th></th><th></th><th></th><th></th><th>$370000.00</th><th>$10200.00</th>
                    </tr>
                </tfoot>
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
        { data: "VENDEDOR" },
        { data: "FACTURA" },
        { data: "CLIENTE" },
        { data: "DESCRIPCION" },
        { data: "ESTATUS" },
        { data: "TIPO" },
        { data: "TOTAL" }
    ];
    cabeceras1 = [
        { data: "VENDEDOR" },
        { data: "FACTURA" },
        { data: "CLIENTE" },
        { data: "DESCRIPCION" },
        { data: "ESTATUS" },
        { data: "TIPO" },
        { data: "TOTAL" }

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
            },
            'scrollY': '30vh',
            'scrollCollapse': true,
            'scrollX': false,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true
    },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var api_total = this.api(), data;
            
            var api_facturado = this.api(), data;
            var api_descuentos = this.api(), data;
            var api_devolucion = this.api(), data;
            var api_drefacturacion = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            
            // Total over all pages
            total_facturado = api_facturado
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;
            $( api_facturado.column( 6 ).footer() ).html(numFormat(total_facturado.toFixed(2)) );
            
             // Total over all pages
            total_descuentos = api_descuentos
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api_descuentos.column( 7 ).footer() ).html(numFormat(total_descuentos.toFixed(2)) );   
            
             // Total over all pages
            total_devolucion = api_devolucion
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api_devolucion.column( 10 ).footer() ).html(numFormat(total_devolucion.toFixed(2)) );      
            
             // Total over all pages
            total_drefacturacion = api_drefacturacion
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api_drefacturacion.column( 11 ).footer() ).html(numFormat(total_drefacturacion.toFixed(2)) );   

            
        }}


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
