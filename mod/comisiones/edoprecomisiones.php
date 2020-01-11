<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Precomisiones');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            Precomisiones
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
            <table id='grid' class='table table-bordered table-condensed table-hover display compact' style="width:100%;">
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th>
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

<?php echo Script();?>
    
<script type="text/javascript">
var timer = 0;
var id = 0;
    
        $(function() {        
            <?php 
                echo JqueryButtons();
                echo JqueryCmbClientes();
            ?>   
        });

        $(function() {
            $("form").on('submit', function(e) {
                $('#CargaGif').show();
                $('#btnEnviar').attr('disabled');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'con-edoprecomisiones.php',
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
    
$(document).ready(function() {

    datos1 = [
        { data: "cve_documento", 'width':'60px'},
        { data: "Sucursal", 'width':'280px' },
        { data: "Id_Cliente", 'width':'60px' },
        { data: "Cliente", 'width':'160px' },
        { data: "id_vendedor", 'width':'60px' },
        
        { data: "Vendedor", 'width':'160px' },
        { data: "Serie", 'width':'60px' },
        { data: "Folio", 'width':'60px' },
        { data: "Subtotal", 'width':'60px' },
        { data: "Impuesto", 'width':'60px' },
        
        { data: "Total", 'width':'60px' },
        { data: "Costo", 'width':'60px' },
        { data: "Margen", 'width':'60px' },
        { data: "Porc_Margen", 'width':'60px' },
        { data: "DiasCredito", 'width':'60px' },
        
        { data: "Fecha", 'width':'60px', type: 'date-euro' },
        { data: "FechaVence", 'width':'60px', type: 'date-euro' },
        { data: "FechaPago", 'width':'60px', type: 'date-euro' },
        { data: "ImportePagado", 'width':'60px' },
        { data: "ImportePagadoS_IVA", 'width':'60px' },
        
        { data: "ImporteNCR", 'width':'60px' },
        { data: "ImporteNCR_IVA", 'width':'60px' },
        { data: "DiasCartera", 'width':'60px' },
    ];
    cabeceras1 = [
        { "title": "CLAVE DOCUMENTO", 'width':'60px', className: "text-left", "targets": 0},
        { "title": "SUCURSAL", 'width':'60px', className: "text-left", "targets": 1},
        { "title": "ID CLIENTE", 'width':'60px', className: "text-right", "targets": 2},
        { "title": "CLIENTE", 'width':'160px', className: "text-right", "targets": 3},
        { "title": "ID VENDEDOR", 'width':'60px', className: "text-right", "targets": 4},
        
        { "title": "VENDEDOR", 'width':'160px', className: "text-right", "targets": 5},
        { "title": "SERIE", 'width':'60px', className: "text-right", "targets": 6},
        { "title": "FOLIO", 'width':'60px', className: "text-right", "targets": 7},
        { "title": "SUBTOTAL", 'width':'60px', className: "text-right", "targets": 8},
        { "title": "IMPUESTO", 'width':'60px', className: "text-right", "targets": 9},
        
        { "title": "TOTAL", 'width':'60px', className: "text-right", "targets": 10},
        { "title": "COSTO", 'width':'60px', className: "text-right", "targets": 11},
        { "title": "MARGEN", 'width':'60px', className: "text-right", "targets": 12},
        { "title": "MARGEN PORCENTAJE", 'width':'60px', className: "text-right", "targets": 13},
        { "title": "DC", 'width':'60px', className: "text-right", "targets": 14},
        
        { "title": "FECHA", 'width':'60px', className: "text-right", type: 'date-euro', "targets": 15},
        { "title": "FECHA VENCE", 'width':'60px', className: "text-right", type: 'date-euro', "targets": 16},
        { "title": "FECHA PAGO", 'width':'60px', className: "text-right", type: 'date-euro', "targets": 17},
        { "title": "IMPORTE PAGADO", 'width':'60px', className: "text-right", "targets": 18},
        { "title": "IMPORTE PAGADO IVA", 'width':'60px', className: "text-right", "targets": 19},
        
        { "title": "IMPORTE NCR", 'width':'60px', className: "text-right", "targets": 20},
        { "title": "IMPORTE NCR IVA", 'width':'60px', className: "text-right", "targets": 21},
        { "title": "DIAS CARTERA", 'width':'60px', className: "text-right", "targets": 22}
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
                    extend: 'csvHtml5',
                    charset: 'UTF-8',
                    bom: true,
                    text: 'csv',
                    filename: '<?php echo "edoresultados_".date('Y-m-d');?>',
                    extension: '.csv', 
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
            'scrollY': '50vh',
            'scrollCollapse': true,
            'scrollX': true,
            'autoWidth':false,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true,
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                var api_total = this.api(), data;

                var api_totalfact = this.api(), data;
                var api_saldohoy = this.api(), data;
                var api_saldoafecha = this.api(), data;
                var api_sinvencer = this.api(), data;
                var api_1_15 = this.api(), data;
                
                var api_16_30 = this.api(), data;
                var api_31_45 = this.api(), data;
                var api_46_60 = this.api(), data;
                var api_61_90 = this.api(), data;
                var api_91_120 = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;
                 // Total over all pages
                total_totalfact = api_totalfact
                    .column( 9 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_totalfact.column( 9 ).footer() ).html(numFormat(total_totalfact.toFixed(2)) );   
                $("#tdtotal").html(numFormat(total_totalfact.toFixed(2)));
                 // Total over all pages
                total_saldohoy = api_saldohoy
                    .column( 10 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldohoy.column( 10 ).footer() ).html(numFormat(total_saldohoy.toFixed(2)) );   
                $("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));                
                 // Total over all pages
                total_saldoafecha = api_saldoafecha
                    .column( 11 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldoafecha.column( 11 ).footer() ).html(numFormat(total_saldoafecha.toFixed(2)) );   
                $("#tdsaldofecha").html(numFormat(total_saldoafecha.toFixed(2)));                
                 // Total over all pages
                total_sinvencer = api_sinvencer
                    .column( 12 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_sinvencer.column( 12 ).footer() ).html(numFormat(total_sinvencer.toFixed(2)) );
                $("#tdsinvencer").html(numFormat(total_sinvencer.toFixed(2)));                
                 // Total over all pages
                total_1_15 = api_1_15
                    .column( 13 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_1_15.column( 13 ).footer() ).html(numFormat(total_1_15.toFixed(2)) );  
                $("#td1-15").html(numFormat(total_1_15.toFixed(2)));                
                 // Total over all pages
                total_16_30 = api_16_30
                    .column( 8 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_16_30.column( 8 ).footer() ).html(numFormat(total_16_30.toFixed(2)) );  
                $("#td16-30").html(numFormat(total_16_30.toFixed(2)));                
                 // Total over all pages
                total_31_45 = api_31_45
                    .column( 19 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_31_45.column( 19 ).footer() ).html(numFormat(total_31_45.toFixed(2)) );  
                $("#td31-45").html(numFormat(total_31_45.toFixed(2)));                
                 // Total over all pages
                total_46_60 = api_46_60
                    .column( 20 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_46_60.column( 20 ).footer() ).html(numFormat(total_46_60.toFixed(2)) );  
                $("#td46-60").html(numFormat(total_46_60.toFixed(2)));                
                 // Total over all pages
                total_61_90 = api_61_90
                    .column( 21 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_61_90.column( 21 ).footer() ).html(numFormat(total_61_90.toFixed(2)) );  
                $("#td61-90").html(numFormat(total_61_90.toFixed(2)));
                 // Total over all pages
                total_91_120 = api_91_120
                    .column( 18 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_91_120.column( 18 ).footer() ).html(numFormat(total_91_120.toFixed(2)) ); 
                $("#td91-120").html(numFormat(total_91_120.toFixed(2)));

        }
        } 

    $('#txtbusqueda').on('keyup change', function() {
      //clear global search values
      table.search('');
      table.column().search().draw();
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
