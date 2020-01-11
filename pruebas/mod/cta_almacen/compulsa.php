<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('CTA ALMACEN RECPED VS CONTA');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            COMPULSA
        </h6>
    </div>
    <div class="panel-body">
        <form id="formulario" method="POST" class="form-inline">
            <input type="hidden" class="form-control" id="TxtEjercicio" name="TxtEjercicio" value="<?php $id = $_GET["e"]; echo $id;?>" >    
            <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
            <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="" > 
            <input type="hidden" class="form-control" id="TxtRow" name="TxtRow" value="" > 
            <input type="hidden" class="form-control" id="CmbSUCURSALES" name="CmbSUCURSALES" value="0" > 
            <input type="hidden" class="form-control" id="TxtMov" name="TxtMov" value="" > 
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
        <style>
            .font-weight-bold{font-weight: bold;}
        </style>
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
        
        <ol class="breadcrumb" style="margin-bottom:0px;">
            <li><strong id="slvl">Nivel 1</strong></li>
            <li><a id="Titulo1" class="font-weight-bold">COMPULSA</a></li>
            <li><a id="Titulo2" style="display:none;"></a></li>
            <li><a id="Titulo3" style="display:none;"></a></li>
            <li><a id="Titulo4" style="display:none;"></a></li>
        </ol>

        <div id="lv1" class="lvl table-responsive">
            <table id='grid1'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th>
                    </tr>
                </tfoot>
            </table>
        </div>   
        <div id="lv2" class="lvl table-responsive" style="display:none;">
            <table id='grid2'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th>
                    </tr>
                </tfoot>
            </table>
        </div>   
        <div id="lv3" class="lvl table-responsive" style="display:none;">
            <table id='grid3'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th>
                    </tr>
                </tfoot>
            </table>
        </div>   
        <div id="lv4" class="lvl table-responsive" style="display:none;">
            <table id='grid4'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
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
<!--        <div class="form-inline">
            <div class="modal-footer col-sm-2">
                <?php echo BusquedaGrid(0,'nombre');?>
            </div>
            <div class="modal-footer col-sm-10">
                <?php echo HtmlButtons();?>
            </div>
        </div>-->
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
/*                echo JqueryButtons();
                echo JqueryCmbClientes();*/
            ?>   
        });

    
$(document).ready(function() {

    datos1 = [
        { data: "GRUPO"},
        { data: "sucursal"},
        { data: "DebeAlmacen"},
        { data: "HaberAlmacen"},
        { data: "DebePoliza"},
        { data: "HaberPoliza"},
        { data: "DIF_DEBE"},
        { data: "DIF_HABER"}
    ];
    cabeceras1 = [
        { "title": "GRUPO", 'width':'80px', className: "text-left bg-warning", "targets": 0},
        { "title": "SUCURSAL", 'width':'80px', className: "text-center bg-warning", "targets": 1,visible:false},
        { "title": "DEBE ALMACEN", 'width':'70px', className: "text-right bg-warning", "targets": 2},
        { "title": "HABER ALMACEN", 'width':'70px', className: "text-right bg-warning", "targets": 3},
        { "title": "DEBE POLIZA", 'width':'70px', className: "text-right bg-danger", "targets": 4},
        { "title": "HABER POLIZA", 'width':'70px', className: "text-right bg-danger", "targets": 5},
        { "title": "DIF DEBE", 'width':'70px', className: "text-right", "targets": 6},
        { "title": "DIF HABER", 'width':'70px', className: "text-right", "targets": 7}
    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
                if( ! table1.data().any()){   
                    $('#grid1').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.GRUPO});
                    
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
                total_saldohoy = api_saldohoy
                    .column( 2 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldohoy.column( 2 ).footer() ).html(numFormat(total_saldohoy.toFixed(2)) );   
                $("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));                
                 // Total over all pages
                total_saldoafecha = api_saldoafecha
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldoafecha.column( 3 ).footer() ).html(numFormat(total_saldoafecha.toFixed(2)) );   
                $("#tdsaldofecha").html(numFormat(total_saldoafecha.toFixed(2)));                
                 // Total over all pages
                total_sinvencer = api_sinvencer
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_sinvencer.column( 4 ).footer() ).html(numFormat(total_sinvencer.toFixed(2)) );
                $("#tdsinvencer").html(numFormat(total_sinvencer.toFixed(2)));                
                 // Total over all pages
                total_1_15 = api_1_15
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_1_15.column( 5 ).footer() ).html(numFormat(total_1_15.toFixed(2)) );  
                $("#td1-15").html(numFormat(total_1_15.toFixed(2)));                
                 // Total over all pages
                total_16_30 = api_16_30
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_16_30.column( 6 ).footer() ).html(numFormat(total_16_30.toFixed(2)) );  
                //var difdebe = total_saldohoy - total_sinvencer;
                $("#td16-30").html(numFormat(total_16_30.toFixed(2)));                
                 // Total over all pages
                total_31_45 = api_31_45
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_31_45.column( 7 ).footer() ).html(numFormat(total_31_45.toFixed(2)) );  
                //var difhaber = total_saldoafecha - total_1_15;
                $("#td31-45").html(numFormat(total_31_45.toFixed(2)));                
             

            }
        } 
        $.fn.dataTable.ext.errMode = 'none';
    var table1 = $('#grid1').DataTable(grid1);
    
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    datos2 = [
        { data: "sucursal"},
        { data: "DebeAlmacen"},
        { data: "HaberAlmacen"},
        { data: "DebePoliza"},
        { data: "HaberPoliza"},
        { data: "DIF_DEBE"},
        { data: "DIF_HABER"}
    ];
    cabeceras2 = [
        { "title": "SUCURSAL", 'width':'80px', className: "text-left bg-warning", "targets": 0},
        { "title": "DEBE ALMACEN", 'width':'70px', className: "text-right bg-warning", "targets": 1},
        { "title": "HABER ALMACEN", 'width':'70px', className: "text-right bg-warning", "targets": 2},
        { "title": "DEBE POLIZA", 'width':'70px', className: "text-right bg-danger", "targets": 3},
        { "title": "HABER POLIZA", 'width':'70px', className: "text-right bg-danger", "targets": 4},
        { "title": "DIF DEBE", 'width':'70px', className: "text-right", "targets": 5},
        { "title": "DIF HABER", 'width':'70px', className: "text-right", "targets": 6}
    ];
    var grid2 = {
            'columns': datos2,
            'columnDefs': cabeceras2,
            'createdRow': function (row,data,index){
                if( ! table2.data().any()){   
                    $('#grid2').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.sucursal});
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
                total_saldohoy = api_saldohoy
                    .column( 1 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldohoy.column( 1 ).footer() ).html(numFormat(total_saldohoy.toFixed(2)) );   
                $("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));                
                 // Total over all pages
                total_saldoafecha = api_saldoafecha
                    .column( 2 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldoafecha.column( 2 ).footer() ).html(numFormat(total_saldoafecha.toFixed(2)) );   
                $("#tdsaldofecha").html(numFormat(total_saldoafecha.toFixed(2)));                
                 // Total over all pages
                total_sinvencer = api_sinvencer
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_sinvencer.column( 3 ).footer() ).html(numFormat(total_sinvencer.toFixed(2)) );
                $("#tdsinvencer").html(numFormat(total_sinvencer.toFixed(2)));                
                 // Total over all pages
                total_1_15 = api_1_15
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_1_15.column( 4 ).footer() ).html(numFormat(total_1_15.toFixed(2)) );  
                $("#td1-15").html(numFormat(total_1_15.toFixed(2)));                
                 // Total over all pages
                total_16_30 = api_16_30
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_16_30.column( 5 ).footer() ).html(numFormat(total_16_30.toFixed(2)) );  
                //var difdebe = total_saldohoy - total_sinvencer;
                $("#td16-30").html(numFormat(total_16_30.toFixed(2)));                
                 // Total over all pages
                total_31_45 = api_31_45
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_31_45.column( 6 ).footer() ).html(numFormat(total_31_45.toFixed(2)) );  
                //var difhaber = total_saldoafecha - total_1_15;
                $("#td31-45").html(numFormat(total_31_45.toFixed(2)));                
             

            }
        } 

        $.fn.dataTable.ext.errMode = 'none';
    var table2 = $('#grid2').DataTable(grid2);
        ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    datos3 = [
        { data: "GRUPO"},
        { data: "sucursal"},
        { data: "DebeAlmacen"},
        { data: "HaberAlmacen"},
        { data: "DebePoliza"},
        { data: "HaberPoliza"},
        { data: "DIF_DEBE"},
        { data: "DIF_HABER"}
    ];
    cabeceras3 = [
        { "title": "GRUPO", 'width':'80px', className: "text-left bg-warning", "targets": 0},
        { "title": "SUCURSAL", 'width':'80px', className: "text-left bg-warning", "targets": 1,visible:false},
        { "title": "DEBE ALMACEN", 'width':'70px', className: "text-right bg-warning", "targets": 2},
        { "title": "HABER ALMACEN", 'width':'70px', className: "text-right bg-warning", "targets": 3},
        { "title": "DEBE POLIZA", 'width':'70px', className: "text-right bg-danger", "targets": 4},
        { "title": "HABER POLIZA", 'width':'70px', className: "text-right bg-danger", "targets": 5},
        { "title": "DIF DEBE", 'width':'70px', className: "text-right", "targets": 6},
        { "title": "DIF HABER", 'width':'70px', className: "text-right", "targets": 7}
    ];
    var grid3 = {
            'columns': datos3,
            'columnDefs': cabeceras3,
            'createdRow': function (row,data,index){
                if( ! table3.data().any()){   
                    $('#grid3').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.GRUPO});
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
                total_saldohoy = api_saldohoy
                    .column( 2 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldohoy.column( 2 ).footer() ).html(numFormat(total_saldohoy.toFixed(2)) );   
                $("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));                
                 // Total over all pages
                total_saldoafecha = api_saldoafecha
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldoafecha.column( 3 ).footer() ).html(numFormat(total_saldoafecha.toFixed(2)) );   
                $("#tdsaldofecha").html(numFormat(total_saldoafecha.toFixed(2)));                
                 // Total over all pages
                total_sinvencer = api_sinvencer
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_sinvencer.column( 4 ).footer() ).html(numFormat(total_sinvencer.toFixed(2)) );
                $("#tdsinvencer").html(numFormat(total_sinvencer.toFixed(2)));                
                 // Total over all pages
                total_1_15 = api_1_15
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_1_15.column( 5 ).footer() ).html(numFormat(total_1_15.toFixed(2)) );  
                $("#td1-15").html(numFormat(total_1_15.toFixed(2)));                
                 // Total over all pages
                total_16_30 = api_16_30
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_16_30.column( 6 ).footer() ).html(numFormat(total_16_30.toFixed(2)) );  
                //var difdebe = total_saldohoy - total_sinvencer;
                $("#td16-30").html(numFormat(total_16_30.toFixed(2)));                
                 // Total over all pages
                total_31_45 = api_31_45
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_31_45.column( 7 ).footer() ).html(numFormat(total_31_45.toFixed(2)) );  
                //var difhaber = total_saldoafecha - total_1_15;
                $("#td31-45").html(numFormat(total_31_45.toFixed(2)));                
            }
        } 

        $.fn.dataTable.ext.errMode = 'none';
    var table3 = $('#grid3').DataTable(grid3);
    
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    datos4 = [
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
    cabeceras4 = [
        { "title": "SUCURSAL", 'width':'80px', className: "text-center bg-warning", "targets": 0,visible:false},
        { "title": "FECHA", 'width':'60px', className: "text-center bg-warning", "targets": 1},
        { "title": "TIPO", 'width':'60px', className: "text-center bg-warning", "targets": 2},
        { "title": "MOVIMIENTO", 'width':'70px', className: "text-center bg-warning", "targets": 3},
        { "title": "TIPO DOC GENERO", 'width':'40px', className: "text-center bg-warning", "targets": 4,visible:false},
        
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
    var grid4 = {
            'columns': datos4,
            'columnDefs': cabeceras4,
            'createdRow': function (row,data,index){
                if( ! table4.data().any()){   
                    $('#grid4').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.GRUPO});
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
            'scrollY': '40vh',
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

        $.fn.dataTable.ext.errMode = 'none';
    var table4 = $('#grid4').DataTable(grid4);
//    $('#CargaGif').show();
//    $('#btnEnviar2').click();
    $(document).on('click', '#btnEnviar2', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 1');
        $('#CargaGif').show();
        $('#CmbSUCURSALES').val("0");
        $('#Titulo2').hide();
        $('#Titulo3').hide();
        $('#Titulo4').hide();
        $('#lv2').hide();
        $('#lv3').hide();
        $('#lv4').hide();
        $('#lv1').show();
        event.preventDefault();
        //$('#btnEnviar').attr('disabled', 'disabled');
        $.ajax({
            type: "POST",
            url: 'con-compulsa.php',
            data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
            success: function(data) {
                $('#CargaGif').hide();
                var res = JSON.parse(data);
                //alert('si entra al 1')
                $('#grid1').dataTable().fnClearTable();
                $('#grid1').dataTable().fnAddData(res);
                $('#grid1').DataTable().draw();
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
    
    $(document).on('click', '#grid1 tr', function(e) {
        e.preventDefault();
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $('#Titulo2').addClass('font-weight-bold');
        $('#slvl').html('Nivel 2');
        var mov = $(this).attr("id");
        $('#Titulo2').html(mov);
        $('#Titulo2').show();
        //alert($(this).parent().attr("id"));
        $('#CargaGif').show();
        $('#lv1').hide();
        event.preventDefault();
        //$('#btnEnviar').attr('disabled', 'disabled');
        var url = '';
        if( mov == 'COMPULSA CTA COSTOS'){
            url = 'con-compulsacostosvsconta.php';
        }
        else if ( mov == 'COMPULSA CTA ALMACEN'){
            url = 'con-compulsaalmavsconta.php';
        }
        $.ajax({
            type: "POST",
            url: url,
            data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
            success: function(data) {
                $('#CargaGif').hide();
                var res = JSON.parse(data);
                $('#lv2').show();
                $('#grid2').dataTable().fnClearTable();
                $('#grid2').dataTable().fnAddData(res);
                $('#grid2').DataTable().draw();
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
    
    $(document).on('click', '#grid2 tr', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 3');
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $('#Titulo3').addClass('font-weight-bold');
        var mov = $(this).attr("id");
        var men = $('#Titulo2').html();
        $('#Titulo3').show();
        //var suc = $('#').html();
        //alert(suc);
        $('#Titulo3').html(mov);
        $('#CmbSUCURSALES').val(mov);
        $('#CargaGif').show();
        $('#lv2').hide();
        event.preventDefault();
        //$('#btnEnviar').attr('disabled', 'disabled');
        var url = '';
        if( men == 'COMPULSA CTA COSTOS'){
            url = 'con-compulsacostosvsconta2.php';
        }
        else if ( men == 'COMPULSA CTA ALMACEN'){
            url = 'con-compulsaalmavscontan2.php';
        }
        $.ajax({
            type: "POST",
            url: url,
            data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
            success: function(data) {
                $('#CargaGif').hide();
                var res = JSON.parse(data);
                $('#lv3').show();
                $('#grid3').dataTable().fnClearTable();
                $('#grid3').dataTable().fnAddData(res);
                $('#grid3').DataTable().draw();
                
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
    
    $(document).on('click', '#grid3 tr', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 4');
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $('#Titulo4').addClass('font-weight-bold');
        var tipo = $(this).attr("id");
        $('#Titulo4').html(tipo);
        $('#Titulo4').show();
        $('#CargaGif').show();
        $('#lv3').hide();
        event.preventDefault();
        //$('#btnEnviar').attr('disabled', 'disabled');
        var url = '';
        if( tipo == 'CTA_ALM_A_C__FACTURA'){
            url = 'con-compulsaalmalmfacturavsconta.php';
        }
        else if ( tipo == 'CTA_ALM_A_C_DEVO_FACT'){
            url = 'con-compulsaalmalmdevofactvsconta.php';
        }
        else if ( tipo == 'CTA_ALM_A_C__REFACTURA'){
            url = 'con-compulsaalmalmrefacturavsconta.php';
        }
        else if ( tipo == 'CTA_ALM_A_CANC_FACTURA'){
            url = 'con-compulsaalmalmcanfactvsconta.php';
        }
        //////////////////////////////////////////////
        else if ( tipo == 'CTA_CTOS_A_C__FACTURA'){
            url = 'con-compulsaconsumovsconta.php';
        }
        else if ( tipo == 'CTA_CTOS_A_C__REFACTURA'){
            url = 'con-compulsarefacvsconta.php';
        }
        else if ( tipo == 'CTA_CTOS_A_C_DEVO_FACT'){
            url = 'con-compulsacostosalmdevofactvsconta.php';
        }
        else if ( tipo == 'CTA_ALM_A_C_TRAREC'){
            url = 'con-compulsaalmtrarecvsconta.php';
        }
        else if ( tipo == 'CTA_ALM_A_C_RECPED'){
            url = 'con-compulsaalmrecpedvsconta.php';
        }
        else if ( tipo == 'CTA_ALM_A_C_DEVPRO'){
            url = 'con-compulsaalmdevprovsconta.php';
        }
        else if ( tipo == 'CTA_ALM_A_C__INDIRECTA'){
            url = 'con-compulsaalmindirectavsconta.php';
        }
        else if ( tipo == 'CTA_CTOS_A_C_CANC_FACT'){
            url = 'con-compulsacostoscancvsconta.php';
        }
        $.ajax({
            type: "POST",
            url: url,
            data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
            success: function(data) {
                $('#CargaGif').hide();
                var res = JSON.parse(data);
                $('#lv4').show();
                $('#grid4').dataTable().fnClearTable();
                $('#grid4').dataTable().fnAddData(res);
                $('#grid4').DataTable().draw();
                
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
    
    $(document).on('click', '#Titulo1', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 1');
        $('#CmbSUCURSALES').val("0");
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $(this).addClass('font-weight-bold');
        $('#Titulo2').hide();
        $('#Titulo3').hide();
        $('#Titulo4').hide();
        $('.lvl').hide();
        $('#lv1').show();
    });
    
    $(document).on('click', '#Titulo2', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 2');
        $('#CmbSUCURSALES').val("0");
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $(this).addClass('font-weight-bold');
        $('#Titulo3').hide();
        $('#Titulo4').hide();
        $('.lvl').hide();
        $('#lv2').show();
    });
    
    $(document).on('click', '#Titulo3', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 3');
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $(this).addClass('font-weight-bold');
        $('#Titulo4').hide();
        $('.lvl').hide();
        $('#lv3').show();
    });
    
    $(document).on('click', '#Titulo4', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 4');
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $(this).addClass('font-weight-bold');
        $('.lvl').hide();
        $('#lv4').show();
    });
});
</script>
</html>
