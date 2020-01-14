<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('CLIENTES SALDOS');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            CLIENTES SALDOS
        </h6>
    </div>
    <style>
        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #fff !important;
            border: 0px !important; 
            border-radius: 0px !important;
        }    
    </style>
    <div class="panel-body" style="padding-top:0px;">
        <form id="formulario" method="POST" class="form-inline row">
            <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="0" > 
            <input type="hidden" class="form-control" id="TxtUser" name="TxtUser" value="<?php $id = $_GET["e"]; echo $id;?>" > 
            <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">De:</span>
                <input type="text" name="TxtEjercicio" id="TxtEjercicio" value="<?php echo date("Y");?>" class="form-control" placeholder="Año"/>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">
                    <span class=" glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
            </div>
        </form>
        <style>
            .font-weight-bold{font-weight: bold;}
            .vta,.ope,.adm{cursor: pointer;}
        </style>

        <div id="lv1" class="lvl table-responsive">
            <table id='grid1'  class='table table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="form-inline">
                <button type="button" id="btnCSV1" class="btn btn-success btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Descargar Excel CSV</button>
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
/*
echo JqueryButtons();
echo JqueryCmbClientes();
*/
            ?>   
            $( "#btnCSV1" ).click(function() {$("#grid1_wrapper .dt-buttons .buttons-csv").click();});
        });

    
$(document).ready(function() {

    datos1 = [
        { data: "Nombre", 'width':'280px'},
        { data: "ene", 'width':'70px'},
        { data: "feb", 'width':'70px'},
        { data: "mar", 'width':'70px'},
        { data: "abr", 'width':'70px'},
        { data: "may", 'width':'70px'},
        { data: "jun", 'width':'70px'},
        { data: "jul", 'width':'70px'},
        { data: "ago", 'width':'70px'},
        { data: "sep", 'width':'70px'},
        { data: "oct", 'width':'70px'},
        { data: "nov", 'width':'70px'},
        { data: "dic", 'width':'70px'},
        { data: "estatus", 'width':'70px'},
    ];

    cabeceras1 = [
        { "title": "CLIENTE", 'width':'280px', className: "", "targets": 0},
        { "title": "ENERO", 'width':'70px', className: "text-right", "targets": 1},
        { "title": "FEBRERO", 'width':'70px', className: "text-right", "targets": 2},
        { "title": "MARZO", 'width':'70px', className: "text-right", "targets": 3},
        { "title": "ABRIL", 'width':'70px', className: "text-right", "targets": 4},
        { "title": "MAYO", 'width':'70px', className: "text-right", "targets": 5},
        { "title": "JUNIO", 'width':'70px', className: "text-right", "targets": 6},
        { "title": "JULIO", 'width':'70px', className: "text-right", "targets": 7},
        { "title": "AGOSTO", 'width':'70px', className: "text-right", "targets": 8},
        { "title": "SEPTIEMBRE", 'width':'70px', className: "text-right", "targets": 9},
        { "title": "OCTUBRE", 'width':'70px', className: "text-right", "targets": 10},
        { "title": "NOVIEMBRE", 'width':'70px', className: "text-right", "targets": 11},
        { "title": "DICIEMBRE", 'width':'70px', className: "text-right", "targets": 12},
        { "title": "ESTATUS", 'width':'70px', className: "text-left", "targets": 13},
    ];
    var grid1 = {
        'columns': datos1,
        'columnDefs': cabeceras1,
        'createdRow': function (row,data,index){
            if( ! table1.data().any()){   
                $('#grid1').dataTable().fnClearTable();
            }
            else{
                //$(row).attr({ id:data.Cliente});
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
                filename: '<?php echo "clientes_saldo_".date('Y-m-d');?>',
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
                filename: '<?php echo "clientes_saldo_".date('Y-m-d');?>',
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
            
            var api_ene = this.api(), data;
            var api_feb = this.api(), data;
            var api_mar = this.api(), data;
            var api_abr = this.api(), data;
            var api_may = this.api(), data;
            var api_jun = this.api(), data;
            var api_jul = this.api(), data;
            var api_ago = this.api(), data;
            var api_sep = this.api(), data;
            var api_oct = this.api(), data;
            var api_nov = this.api(), data;
            var api_dic = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;

            total_ene = api_ene
                .column( 1 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_ene.column( 1 ).footer() ).html(numFormat(total_ene.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
            
            total_mar = api_mar
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_mar.column( 2 ).footer() ).html(numFormat(total_mar.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
            
            total_feb = api_feb
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_feb.column( 3 ).footer() ).html(numFormat(total_feb.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2))); 
            
            total_abr = api_abr
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_abr.column( 4 ).footer() ).html(numFormat(total_abr.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
            
            total_may = api_may
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_may.column( 5 ).footer() ).html(numFormat(total_may.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
            
            total_jun = api_jun
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_jun.column( 6 ).footer() ).html(numFormat(total_jun.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
            
            total_jul = api_jul
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_jul.column( 7 ).footer() ).html(numFormat(total_jul.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
            
            total_ago = api_ago
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_ago.column( 8 ).footer() ).html(numFormat(total_ago.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
            
            total_sep = api_sep
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_sep.column( 9 ).footer() ).html(numFormat(total_sep.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
            
            total_oct = api_oct
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_oct.column( 10 ).footer() ).html(numFormat(total_oct.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
            
            total_nov = api_nov
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_nov.column( 11 ).footer() ).html(numFormat(total_nov.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
            
            total_dic = api_dic
                .column( 12 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api_dic.column( 12 ).footer() ).html(numFormat(total_dic.toFixed(2)) );   
            //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));  
        }
    } 

    $.fn.dataTable.ext.errMode = 'none';
    var table1 = $('#grid1').DataTable(grid1);
   

//    $('#CargaGif').show();
//    $('#btnEnviar2').click();
    $(document).on('click', '#btnEnviar2', function(e) {
        e.preventDefault();
        $('#CargaGif').show();
        event.preventDefault();
        //$('#btnEnviar').attr('disabled', 'disabled');
        $.ajax({
            type: "POST",
            url: 'con-clientessaldo.php',
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
    
});
</script>
</html>
