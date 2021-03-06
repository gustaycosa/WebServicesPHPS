<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('GASTOS');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            GASTOS GENERALES POR SUCURSAL
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
                <input type="date" name="Fini" id="Fini" value="<?php echo date("Y"."-"."01"."-"."01");?>" class="form-control" placeholder="Rango Fecha Inicial"/>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">A:</span>
                <input type="date" name="Ffin" id="Ffin" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Rango Fecha Inicial"/>
            </div>
            <div class="input-group col-xs-6 col-sm-1" style="float:left;">
                <button type="button" id="btnmonth" class="btn btn-info btn-sm" onMouseOver=""><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Al mes</button>
            </div>
            <div class="input-group col-xs-6 col-sm-1" style="float:left;">
                <button type="button" id="btnyear" name="btnyear" class="btn btn-info btn-sm" onMouseOver="">
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Al año</button>
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
                        <th></th><th></th>
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
/*                echo JqueryButtons();
                echo JqueryCmbClientes();*/
            ?>   
            $( "#btnCSV1" ).click(function() {$("#grid1_wrapper .dt-buttons .buttons-csv").click();});
        });

    
$(document).ready(function() {

    datos1 = [
        { data: "Id_Empresa", 'width':'80px'},
        { data: "Id_Sucursal", 'width':'80px'},
        { data: "Periodo", 'width':'60px'},
        { data: "id_cuentactb", 'width':'70px'},
        { data: "Nombre", 'width':'180px'},
        { data: "Depto", 'width':'70px'},
        { data: "SaldoDeudor", 'width':'60px'}
    ];

    cabeceras1 = [
        { "title": "EMPRESA", 'width':'80px', className: "", "targets": 0},
        { "title": "SUCURSAL", 'width':'80px', className: "", "targets": 1},
        { "title": "PERIODO", 'width':'60px', className: "", "targets": 2},
        { "title": "CUENTA CTB", 'width':'70px', className: "text-right", "targets": 3},
        { "title": "NOMBRE CUENTA", 'width':'180px', className: "text-left", "targets": 4},
        { "title": "DEPTO", 'width':'70px', className: "text-left", "targets": 5},
        { "title": "SALDO DEUDOR", 'width':'70px', className: "text-right", "targets": 6}
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
                filename: '<?php echo "gastos_gral_".date('Y-m-d');?>',
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
                filename: '<?php echo "gastos_gral_".date('Y-m-d');?>',
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
            var api_saldohoy9 = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;

            total_saldohoy9 = api_saldohoy9
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api_saldohoy9.column( 6 ).footer() ).html(numFormat(total_saldohoy9.toFixed(2)) );   
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
            url: 'con-selgastosgral.php',
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
    
    $(document).on('click', '#btnmonth', function(e) {
        var now1 = new Date();
        var day = "01";
        var month = ("0" + (now1.getMonth() + 1)).slice(-2);
        var firstday = now1.getFullYear()+"-"+(month)+"-"+(day) ;
        $('#Fini').val(firstday);
        
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
        $('#Ffin').val(today);
    });
    
    $(document).on('click', '#btnyear', function(e) {
        var now1 = new Date();
        var day = "01";
        var month = "01";
        var firstday = now1.getFullYear()+"-"+(month)+"-"+(day) ;
        $('#Fini').val(firstday);
        
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
        $('#Ffin').val(today);
    });
});
</script>
</html>
