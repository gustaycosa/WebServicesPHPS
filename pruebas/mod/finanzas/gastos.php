<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('GASTOS');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            GASTOS
        </h6>
    </div>
    <div class="panel-body">
        <form id="formulario" method="POST" class="form-inline">   
            <input type="hidden" class="form-control" id="TxtUser" name="TxtUser" value="<?php $id = $_GET["e"]; echo $id;?>" > 
            <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
            <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="" > 
            <input type="hidden" class="form-control" id="TxtRow" name="TxtRow" value="" > 
            <input type="hidden" class="form-control" id="TxtMov" name="TxtMov" value="" > 
            <input type="hidden" class="form-control" id="TxtSuc" name="TxtSuc" value="" > 
            <div class="form-group">
                <?php echo TxtPeriodo();?>
            </div>
            <div class="form-group">
                
                    <span class="">Mes:</span>
                    <select id="TxtMes" name="TxtMes" class="form-control">
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>

            </div>
            <div class="form-group">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
            </div>
        </form>
        <style>
            .font-weight-bold{font-weight: bold;}
            .vta,.ope,.adm{cursor: pointer;}
        </style>
        
        <ol class="breadcrumb" style="margin-bottom:0px;">
            <li><strong id="slvl">Nivel 1</strong></li>
            <li><a id="Titulo1" class="font-weight-bold">GASTOS GENERALES</a></li>
            <li><a id="Titulo2" style="display:none;"></a></li>
            <li><a id="Titulo3" style="display:none;"></a></li>
            <li><a id="Titulo4" style="display:none;"></a></li>
        </ol>

        <div id="lv1" class="lvl table-responsive">
            <table id='grid1'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="form-inline">
                <button type="button" id="btnCSV1" class="btn btn-success btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Descargar Excel CSV</button>
            </div>
        </div>   
        <div id="lv2" class="lvl table-responsive" style="display:none;">
            <table id='grid2'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="form-inline">
                <button type="button" id="btnCSV2" class="btn btn-success btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Descargar Excel CSV</button>
            </div>
        </div>   
        <div id="lv3" class="lvl table-responsive" style="display:none;">
            <table id='grid3'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="form-inline">
                <button type="button" id="btnCSV3" class="btn btn-success btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Descargar Excel CSV</button>
            </div>
        </div>   
        <div id="lv4" class="lvl table-responsive" style="display:none;">
            <table id='grid4'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="form-inline">
                <button type="button" id="btnCSV4" class="btn btn-success btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Descargar Excel CSV</button>
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
/*                echo JqueryButtons();
                echo JqueryCmbClientes();*/
            ?>   
            $( "#btnCSV1" ).click(function() {$("#grid1_wrapper .dt-buttons .buttons-csv").click();});
            $( "#btnCSV2" ).click(function() {$("#grid2_wrapper .dt-buttons .buttons-csv").click();});
            $( "#btnCSV3" ).click(function() {$("#grid3_wrapper .dt-buttons .buttons-csv").click();});
            $( "#btnCSV4" ).click(function() {$("#grid4_wrapper .dt-buttons .buttons-csv").click();});
        });

    
$(document).ready(function() {

    datos1 = [
        { data: "Id_Empresa"},
        { data: "Periodo"},
        { data: "GastosVenta"},
        { data: "GastosAdministracion"},
        { data: "GastosOperacion"}
    ];
    cabeceras1 = [
        { "title": "EMPRESA", 'width':'80px', className: "", "targets": 0},
        { "title": "PERIODO", 'width':'80px', className: "", "targets": 1},
        { "title": "GASTOS DE VENTA", 'width':'70px', className: "text-right bg-info vta", "targets": 2},
        { "title": "GASTOS DE ADMINISTRACION", 'width':'70px', className: "text-right bg-success adm", "targets": 3},
        { "title": "GASTOS DE OPERACION", 'width':'70px', className: "text-right bg-warning ope", "targets": 4},
    ];
    var grid1 = {
        'columns': datos1,
        'columnDefs': cabeceras1,
        'createdRow': function (row,data,index){
            if( ! table1.data().any()){   
                $('#grid1').dataTable().fnClearTable();
            }
            else{
                $(row).attr({ id:data.Periodo});
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
                filename: '<?php echo "gastos_lv1_".date('Y-m-d');?>',
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
                filename: '<?php echo "gastos_lv1_".date('Y-m-d');?>',
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

            var api_saldohoy = this.api(), data;

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
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api_saldohoy.column( 4 ).footer() ).html(numFormat(total_saldohoy.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));            
        }
    } 

    $.fn.dataTable.ext.errMode = 'none';
    var table1 = $('#grid1').DataTable(grid1);
   
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    datos2 = [
        { data: "Id_Empresa", 'width':'70px',},
        { data: "Periodo", 'width':'70px',},
        { data: "Id_Sucursal", 'width':'70px',},
        { data: "Saldo", 'width':'70px',}
    ];
    cabeceras2 = [
        { "title": "EMPRESA", 'width':'70px', className: "", "targets": 0},
        { "title": "PERIODO", 'width':'70px', className: "", "targets": 1},
        { "title": "SUCURSAL", 'width':'70px', className: "", "targets": 2},
        { "title": "SALDO", 'width':'70px', className: "text-right", "targets": 3},
    ];
    var grid2 = {
            'columns': datos2,
            'columnDefs': cabeceras2,
            'createdRow': function (row,data,index){
                if( ! table2.data().any()){   
                    $('#grid2').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.Periodo,mov:data.id_cuentactb,nom:data.Id_Sucursal});
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
                    filename: '<?php echo "gastos_lv2_".date('Y-m-d');?>',
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
                    filename: '<?php echo "gastos_lv2_".date('Y-m-d');?>',
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

                var api_saldohoy = this.api(), data;

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
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldohoy.column( 3 ).footer() ).html(numFormat(total_saldohoy.toFixed(2)) );           

            }
        } 

        $.fn.dataTable.ext.errMode = 'none';
    var table2 = $('#grid2').DataTable(grid2);

   ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    datos3 = [
        { data: "Id_Empresa", 'width':'70px',},
        { data: "Periodo", 'width':'70px',},
        { data: "id_cuentactb", 'width':'70px',},
        { data: "NomCuenta", 'width':'170px',},
        { data: "Saldo", 'width':'70px',}
    ];
    cabeceras3 = [
        { "title": "EMPRESA", 'width':'70px', className: "", "targets": 0},
        { "title": "PERIODO", 'width':'70px', className: "", "targets": 1},
        { "title": "CUENTA CONTABLE", 'width':'70px', className: "", "targets": 2},
        { "title": "NOMBRE CUENTA", 'width':'170px', className: "", "targets": 3},
        { "title": "SALDO", 'width':'70px', className: "text-right", "targets": 4},
    ];
    var grid3 = {
            'columns': datos3,
            'columnDefs': cabeceras3,
            'createdRow': function (row,data,index){
                if( ! table3.data().any()){   
                    $('#grid3').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.Periodo,mov:data.id_cuentactb,nom:data.NomCuenta});
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
                    filename: '<?php echo "gastos_lv3_".date('Y-m-d');?>',
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
                    filename: '<?php echo "gastos_lv3_".date('Y-m-d');?>',
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

                var api_saldohoy = this.api(), data;

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
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldohoy.column( 4 ).footer() ).html(numFormat(total_saldohoy.toFixed(2)) );           

            }
        } 

        $.fn.dataTable.ext.errMode = 'none';
    var table3 = $('#grid3').DataTable(grid3);

        ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    datos4 = [
        { data: "Id_Empresa", 'width':'30px'},
        { data: "Periodo", 'width':'30px'},
        { data: "id_cuentactb", 'width':'70px'},
        { data: "NomCuenta", 'width':'170px'},
        { data: "Sublibro", 'width':'30px'},
        { data: "NomSublibro", 'width':'170px'},
        { data: "Saldo", 'width':'50px'}
    ];
    cabeceras4 = [
        { "title": "EMPRESA", 'width':'30px', className: "text-left", "targets": 0},
        { "title": "PERIODO", 'width':'30px', className: "text-left", "targets": 1},
        { "title": "CUENTA CONTABLE", 'width':'70px', className: "text-left", "targets": 2},
        { "title": "NOMBRE", 'width':'170px', className: "text-left", "targets": 3},
        { "title": "SUBLIBRO", 'width':'30px', className: "text-left", "targets": 4},
        { "title": "NOMBRE SUBLIBRO", 'width':'170px', className: "text-left", "targets": 5},
        { "title": "SALDO", 'width':'50px', className: "text-right", "targets": 6}
    ];
    var grid4 = {
            'columns': datos4,
            'columnDefs': cabeceras4,
            'createdRow': function (row,data,index){
                if( ! table4.data().any()){   
                    $('#grid4').dataTable().fnClearTable();
                }
                else{
                    //$(row).attr({ id:data.GRUPO});
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
                    filename: '<?php echo "gastos_lv4_".date('Y-m-d');?>',
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
                    filename: '<?php echo "gastos_lv4_".date('Y-m-d');?>',
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

                var api_saldohoy = this.api(), data;

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
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldohoy.column( 6 ).footer() ).html(numFormat(total_saldohoy.toFixed(2)) );   
                //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));            
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
        $('#Titulo2').hide();
        $('#Titulo3').hide();
        $('#lv2').hide();
        $('#lv3').hide();
        $('#lv1').show();
        event.preventDefault();
        //$('#btnEnviar').attr('disabled', 'disabled');
        $.ajax({
            type: "POST",
            url: 'con-selgastos1.php',
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
//                $('#CargaGif').show();
//                $('#btnEnviar2').attr('disabled');
//                e.preventDefault();
//                $.ajax({
//                    type: "POST",
//                    url: 'con-selgastos1.php',
//                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
//                    success: function(data) {
//                        $('#btnEnviar').removeAttr('disabled');
//                        $('#CargaGif').hide();
//                        var res = JSON.parse(data);
//                        $('#grid').dataTable().fnClearTable();
//                        $('#grid').dataTable().fnAddData(res);
//                        $('#grid').DataTable().draw();
//                    },
//                    error: function(error) {
//                        ('#btnEnviar').removeAttr('disabled');
//                        $('#CargaGif').hide();
//                        console.log(error);
//                        alert('Algo salio mal :S');
//                    }
//                });
//
//                return false; // Evitar ejecutar el submit del formulario.
//            });
    $(document).on('click', '#grid1 tr td', function(e) {
        e.preventDefault();
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $('#Titulo2').addClass('font-weight-bold');
        $('#slvl').html('Nivel 2');
        var mov = $(this).parent().attr("id");
        var id = $(this).parent().attr("id");
        $("#TxtRow").val(id);
        
        $('#Titulo2').show();
        //alert($(this).parent().attr("id"));
        $('#CargaGif').show();
        $('#lv1').hide();
        //$('#btnEnviar2').attr('disabled', 'disabled');
        var url = '';
        if( $(this).hasClass("vta")){
            $('#TxtClave').val("6102");
            mov = 'GASTOS DE VENTAS';
        }
        else if ( $(this).hasClass("adm")){
            $('#TxtClave').val("6103");
            mov = 'GASTOS DE ADMINISTRACION';
        }
        else if ( $(this).hasClass("ope")){
            $('#TxtClave').val("6104");
            mov = 'GASTOS DE OPERACION';
        }
        $('#Titulo2').html(mov);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: 'con-selgastos2.php',
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
        var mov = $(this).attr("mov");
        var id = $(this).attr("id");
        $("#TxtRow").val(id);
        $('#TxtClave').val(mov);
        var men = $('#Titulo2').html();
        //var suc = $(this).attr("nom");
        $('#Titulo3').show();
        //var suc = $('#').html();
        //alert(suc);
        var nom =  $(this).attr("nom");
        $('#TxtSuc').val(nom);
        $('#Titulo3').html(mov + ' - ' + nom);
        $('#CmbSUCURSALES').val(mov);
        $('#CargaGif').show();
        $('#lv2').hide();
        event.preventDefault();
        //$('#btnEnviar').attr('disabled', 'disabled');
//        var url = '';
//        if( men == 'COMPULSA CTA COSTOS'){
//            url = 'con-compulsacostosvsconta2.php';
//        }
//        else if ( men == 'COMPULSA CTA ALMACEN'){
//            url = 'con-compulsaalmavscontan2.php';
//        }
        $.ajax({
            type: "POST",
            url: 'con-selgastos3.php',
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
        var mov = $(this).attr("mov");
        var id = $(this).attr("id");
        $("#TxtRow").val(id);
        $('#TxtClave').val(mov);
        var men = $('#Titulo2').html();
        //var suc = $(this).attr("nom");
        $('#Titulo4').show();
        //var suc = $('#').html();
        //alert(suc);
        var nom =  $(this).attr("nom");
        //$('#TxtSuc').val(nom);
        $('#Titulo4').html(mov + ' - ' + nom);
        $('#CmbSUCURSALES').val(mov);
        $('#CargaGif').show();
        $('#lv3').hide();
        event.preventDefault();
        //$('#btnEnviar').attr('disabled', 'disabled');
//        var url = '';
//        if( men == 'COMPULSA CTA COSTOS'){
//            url = 'con-compulsacostosvsconta2.php';
//        }
//        else if ( men == 'COMPULSA CTA ALMACEN'){
//            url = 'con-compulsaalmavscontan2.php';
//        }
        $.ajax({
            type: "POST",
            url: 'con-selgastos4.php',
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
