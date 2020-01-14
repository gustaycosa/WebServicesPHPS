<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Existencias');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            Trayectoria de facturas
        </h6>
    </div>
    <div class="panel-body">
        <form id="formulario" method="POST" class="form-inline">
            <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="0" > 
            <input type="hidden" class="form-control" id="TxtUser" name="TxtUser" value="<?php $id = $_GET["e"]; echo $id;?>" > 
            <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
<!--            <div class="form-group">
                <label for="inputtext3" class="col-sm-3 control-label">Sucursal:</label>
                <div class="col-sm-9 ">
                    <?php /*echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES");*/ ?>
                </div>
            </div>-->
            <div class="form-group">
                <?php echo TxtDateRango(); ?>
            </div>
            <div class="input-group">
                <?php echo CmbClientes(); ?>
            </div>
            <div class="input-group">
                <label for="inputtext3" class="col-sm-3 control-label">Tipo:</label>
                <div class="col-sm-9 ">
                    <select id="cmbtipo" name="cmbtipo" class="form-control">
                        <option value="PAGO">PAGO</option>
                        <option value="FACT">FACTURA</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputtext3" class="col-sm-3 control-label">Sucursal:</label>
                <div class="col-sm-9 ">
                    <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES", $emp); ?>
                </div>
            </div>
            <div class="input-group">
                <label for="inputtext3" class="col-sm-3 control-label">Moneda:</label>
                <div class="col-sm-9 ">
                    <select id="cmbmoneda" name="cmbmoneda" class="form-control">
                        <option value="PESOS">PESOS</option>
                        <option value="DOLARES">DOLARES</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
            </div>

        </form>
        <div class="table-responsive">
            <table id='grid'  class='table table-striped table-bordered table-condensed table-hover display compact dataTable no-footer' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
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
            
            var typingTimer;
            var doneTypingInterval = 1500;
            $("#TxtCliente").keyup(function(){
                clearTimeout(typingTimer);
                if ($("#TxtCliente").val()) {
                   typingTimer = setTimeout(doneTyping, doneTypingInterval);
                }
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
var b = '';
    datos1 = [
        //{ data: "ORDEN", 'width':'60px'},
        { data: "Cvetipodocto", 'width':'60px'},
        { data: "Sucursal", 'width':'60px'},
        { data: "Id_Cliente", 'width':'60px'},
        { data: "Cliente", 'width':'200px'},
        { data: "FACTURA", 'width':'60px'},
        { data: "FECHAFACTURA", 'width':'60px', type: 'date-euro'},
        { data: "FECHAVENCE", 'width':'60px', type: 'date-euro'},
        { data: "PAGO", 'width':'60px'},
        { data: "FOLIO", 'width':'60px'},
        { data: "FECHAPAGO", 'width':'60px', type: 'date-euro'},
        { data: "FECHAAPLICAPAGO", 'width':'60px', type: 'date-euro'},
        { data: "DC", 'width':'60px'},
        { data: "DV", 'width':'60px'},
        { data: "TOTALFACTURA", 'width':'60px'},
        { data: "TOTALPAGO", 'width':'60px'},
        { data: "Abono", 'width':'60px'},
        { data: "SALDOFACTURA", 'width':'60px'},
        { data: "SALDOPAGO", 'width':'60px'},
        { data: "TimbreFact", 'width':'100px'},
        { data: "TimbrePago", 'width':'100px'},
    ];
   
    cabeceras1 = [
        //{ "title": "ORDEN", 'width':'60px', className: "text-left", "targets": 0},
        { "title": "TIPO DOCTO.", 'width':'60px', className: "text-left", "targets": 0},
        { "title": "SUCURSAL", 'width':'60px', className: "text-left", "targets": 1},
        { "title": "ID CLIENTE", 'width':'50px', className: "text-left", "targets": 2},
        { "title": "CLIENTE", 'width':'200px', className: "text-left", "targets": 3},
        { "title": "FACTURA", 'width':'60px', className: "text-left", "targets": 4},
        { "title": "FECHA FACTURA", 'width':'60px', className: "text-center", type: 'date-euro', "targets": 5},
        { "title": "FECHA VENCE", 'width':'60px', className: "text-center", type: 'date-euro', "targets": 6},
        { "title": "PAGO", 'width':'60px', className: "text-center", "targets": 7},
        { "title": "FOLIO", 'width':'60px', className: "text-center", "targets": 8},
        { "title": "FECHA PAGO", 'width':'60px', className: "text-right", type: 'date-euro', "targets": 9},
        { "title": "FECHA AP.PAGO", 'width':'60px', className: "text-right", type: 'date-euro', "targets": 10},
        { "title": "DC", 'width':'60px', className: "text-right", "targets": 11},
        { "title": "DV", 'width':'60px', className: "text-right", "targets": 12},
        { "title": "TOTAL FACTURA", 'width':'60px', className: "text-right", "targets": 13},
        { "title": "TOTAL PAGO", 'width':'60px', className: "text-right", "targets": 14},
        { "title": "ABONO", 'width':'60px', className: "text-right", "targets": 15},
        { "title": "SALDO FACTURA", 'width':'60px', className: "text-right", "targets": 16},
        { "title": "SALDO PAGO", 'width':'60px', className: "text-right", "targets": 17},
        { "title": "TIMBRE FACT.", 'width':'100px', className: "text-right", "targets": 18},
        { "title": "TIMBRE PAGO", 'width':'100px', className: "text-right", "targets": 19},
    ];    
    
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
                if( ! table.data().any()){   
                $('#grid1').dataTable().fnClearTable();
                }
                else{
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
                    filename: '<?php echo "trayectfacturas_".date('Y-m-d');?>',
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
            'scrollY': '60vh',
            'scrollCollapse': true,
            'scrollX': true,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true,
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
                    i.replace(/[\$,-]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            
            // Total over all pages
            total_facturado = api_facturado
                .column( 15 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;
            $( api_facturado.column( 15 ).footer() ).html(numFormat(total_facturado.toFixed(2)) );
            
             // Total over all pages
            total_descuentos = api_descuentos
                .column( 16 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api_descuentos.column( 16 ).footer() ).html(numFormat(total_descuentos.toFixed(2)) );   
            
             // Total over all pages
            total_devolucion = api_devolucion
                .column( 17 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api_devolucion.column( 17 ).footer() ).html(numFormat(total_devolucion.toFixed(2)) );      

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
    $.fn.dataTable.ext.errMode = 'none';
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
                url: 'con-reporte1_2.php',
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
