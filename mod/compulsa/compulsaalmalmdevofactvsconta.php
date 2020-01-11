<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('CTA ALMACEN ALMACEN DEVO_FACT VS CONTA');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            CTA ALMACEN ALMACEN DEVO_FACT VS CONTA
        </h6>
    </div>
    <div class="panel-body">
        <form id="formulario" method="POST" class="form-inline">
            <input type="hidden" class="form-control" id="TxtEjercicio" name="TxtEjercicio" value="<?php $id = $_GET["e"]; echo $id;?>" >    
            <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
            <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="" > 
            <input type="hidden" class="form-control" id="TxtRow" name="TxtRow" value="" > 
            <input type="hidden" class="form-control" id="TxtMov" name="TxtMov" value="" > 
            <div class="form-group">
                <label for="inputtext3" class="col-sm-3 control-label">Sucursal:</label>
                <div class="col-sm-9 ">
                    <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES", $emp); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo TxtPeriodo();?>
            </div>
            <div class="form-group">
                <?php echo CmbMes();?>
            </div>
            <div class="form-group">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
            </div>
        </form>
        
        <div class="table-responsive">
            <table id='gridtotales'  class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <thead>
                    <tr>
                        <!--<th>COSTO NETO</th>-->
                        <th>DEBE ALMACEN</th>
                        <th>HABER ALMACEN</th>
                        <th>DEBE POLIZA</th>
                        <th>HABER POLIZA</th>
                        <th>DIFERENCIA DEBE</th>
                        <th>DIFERENCIA HABER</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!--<td id="tdtotal" class="text-right"></td>-->
                        <td id="tdsaldohoy" class="text-right"></td>
                        <td id="tdsaldofecha" class="text-right"></td>
                        <td id="tdsinvencer" class="text-right"></td>
                        <td id="td1-15" class="text-right"></td>
                        <td id="td16-30" class="text-right"></td>
                        <td id="td31-45" class="text-right"></td>
                    </tr>
                </tbody>
            </table>
        </div>   
        
        <div class="table-responsive">
            <table id='grid'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
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

    
$(document).ready(function() {

    datos1 = [
        { data: "Sucursal"},
        { data: "Fecha"},
        { data: "Tipo"},
        { data: "movimiento"},
        { data: "TipoDocGenero"},
        
        { data: "MovtoGenero"},
        { data: "articulo"},
        { data: "nombre"},
        { data: "entrada"},
        { data: "salida"},
        
        { data: "costoneto"},
        { data: "DebeAlmacen"},
        { data: "HaberAlmacen"},
        { data: "Poliza"},
        { data: "FechaPoliza"},
        
        { data: "id_cuentactb"},
        { data: "DebePoliza"},
        { data: "HaberPoliza"},
        { data: "DIF_DEBE"},
        { data: "DIF_HABER"}
    ];
    cabeceras1 = [
        { "title": "SUCURSAL", 'width':'80px', className: "text-center bg-warning", "targets": 0},
        { "title": "FECHA", 'width':'60px', className: "text-center bg-warning", "targets": 1},
        { "title": "TIPO", 'width':'60px', className: "text-center bg-warning", "targets": 2},
        { "title": "MOVIMIENTO", 'width':'70px', className: "text-center bg-warning", "targets": 3},
        { "title": "TIPO DOC GENERO", 'width':'40px', className: "text-center bg-warning", "targets": 4},
        
        { "title": "MOVIMIENTO GENERO", 'width':'70px', className: "text-right bg-warning", "targets": 5},
        { "title": "ARTICULO", 'width':'60px', className: "text-center bg-warning", "targets": 6},
        { "title": "NOMBRE", 'width':'220px', className: "text-left bg-warning", "targets": 7},
        { "title": "ENTRADA", 'width':'40px', className: "text-right bg-warning", "targets": 8},
        { "title": "SALIDA", 'width':'40px', className: "text-right bg-warning", "targets": 9},
        
        { "title": "COSTO NETO", 'width':'70px', className: "text-right bg-warning", "targets": 10},
        { "title": "DEBE ALMACEN", 'width':'70px', className: "text-right bg-warning", "targets": 11},
        { "title": "HABER ALMACEN", 'width':'70px', className: "text-right bg-warning", "targets": 12},
        { "title": "POLIZA", 'width':'140px', className: "text-right bg-danger", "targets": 13},
        { "title": "FECHA POLIZA", 'width':'60px', className: "text-right bg-danger", "targets": 14},
        
        { "title": "ID CUENTA", 'width':'80px', className: "text-right bg-danger", "targets": 15},
        { "title": "DEBE POLIZA", 'width':'70px', className: "text-right bg-danger", "targets": 16},
        { "title": "HABER POLIZA", 'width':'70px', className: "text-right bg-danger", "targets": 17},
        { "title": "DIF DEBE", 'width':'70px', className: "text-right", "targets": 18},
        { "title": "DIF HABER", 'width':'70px', className: "text-right", "targets": 19}
    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
                if( ! table.data().any()){   
                    $('#grid').dataTable().fnClearTable();
                }
                else{
/*                    var a = data.DebeAlmacen;
                    var b = data.DebePoliza;
                    var c = data.HaberAlmacen;
                    var d = data.HaberPoliza;
                    //debe
                    if( a != b){
                        $(row).addClass('bg-warning');
                    }
                    //haber
                     if( d != c){
                        $(row).addClass('bg-warning');
                    }*/
                }
            },
            dom: 'lfBrtip', 
            paging: false,
            searching: true,
            ordering: true,
            buttons: [
                {
                    extend: 'csvHtml5',
                    charset: 'UTF-8',
                    bom: true,
                    text: 'CSV',
                    filename: '<?php echo "historialcartera_".date('Y-m-d');?>',
                    extension: '.csv', 
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    message: 'PDF creado desde el sistema en linea del tayco.',
                    text: 'XLS',
                    filename: '<?php echo "historialcartera_".date('Y-m-d');?>',
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
                var api_mayor120 = this.api(), data;

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
                    .column( 10 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_totalfact.column( 10 ).footer() ).html(numFormat(total_totalfact.toFixed(2)) );   
                $("#tdtotal").html(numFormat(total_totalfact.toFixed(2)));
                 // Total over all pages
                total_saldohoy = api_saldohoy
                    .column( 11 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldohoy.column( 11 ).footer() ).html(numFormat(total_saldohoy.toFixed(2)) );   
                $("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));                
                 // Total over all pages
                total_saldoafecha = api_saldoafecha
                    .column( 12 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldoafecha.column( 12 ).footer() ).html(numFormat(total_saldoafecha.toFixed(2)) );   
                $("#tdsaldofecha").html(numFormat(total_saldoafecha.toFixed(2)));                
                 // Total over all pages
                total_sinvencer = api_sinvencer
                    .column( 16 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_sinvencer.column( 16 ).footer() ).html(numFormat(total_sinvencer.toFixed(2)) );
                $("#tdsinvencer").html(numFormat(total_sinvencer.toFixed(2)));                
                 // Total over all pages
                total_1_15 = api_1_15
                    .column( 17 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_1_15.column( 17 ).footer() ).html(numFormat(total_1_15.toFixed(2)) );  
                $("#td1-15").html(numFormat(total_1_15.toFixed(2)));                
                 // Total over all pages
                total_16_30 = api_16_30
                    .column( 18 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_16_30.column( 18 ).footer() ).html(numFormat(total_16_30.toFixed(2)) );  
                //var difdebe = total_saldohoy - total_sinvencer;
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
                //var difhaber = total_saldoafecha - total_1_15;
                $("#td31-45").html(numFormat(total_31_45.toFixed(2)));                
             

        }
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
    $.fn.dataTable.ext.errMode = 'none';
    var table = $('#grid').DataTable(grid1);

//    $('#CargaGif').show();
//    $('#btnEnviar2').click();
    $(document).on('click', '#btnEnviar2', function(e) {
            e.preventDefault();
            $('#CargaGif').show();
            event.preventDefault();
            //$('#btnEnviar').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: 'con-compulsaalmalmdevofactvsconta.php',
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
