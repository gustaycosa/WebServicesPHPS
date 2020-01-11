<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Trayectoria de facturas pago');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            Trayectoria de facturas pago
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
            <input type="hidden" class="form-control" id="TxtEjercicio" name="TxtEjercicio" value="<?php $id = $_GET["e"]; echo $id;?>" >    
            <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
            <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="0" > 
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">De:</span>
                <input type="date" name="Fini" id="Fini" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Rango Fecha Inicial"/>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">A:</span>
                <input type="date" name="Ffin" id="Ffin" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Rango Fecha Inicial"/>
            </div>
            <div class="input-group">
                <?php echo CmbClientes(); ?>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">Tipo:</span>
                <select id="cmbtipo" name="cmbtipo" class="form-control">
                    <option value="PAGO">PAGO</option>
                    <option value="FACT">FACTURA</option>
                </select>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">Sucursal:</span>
                <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES", $emp); ?>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">Moneda:</span>
                <select id="cmbmoneda" name="cmbmoneda" class="form-control">
                    <option value="PESOS">PESOS</option>
                    <option value="DOLARES">DOLARES</option>
                </select>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
            </div>

        </form>
        <div class="table-responsive row">
            <table id='grid'  class='table table-striped table-bordered table-condensed table-hover display compact dataTable no-footer' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th>
                    </tr>
                </tfoot>
            </table>
        </div>                
        <div class="form-inline row">
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

            function doneTyping (){
                var value = $("#TxtCliente").val();
                $("#TxtClave").text( value );
                $("#CargaGif").show();
                $.ajax({
                    type: "POST",
                    url: "../generales/con-cmbclientes.php",
                    data: $("#TxtCliente").serialize(), 
                    success: function(data) {
                        $("#CargaGif").hide();
                        $(".dropdown-menu").html(data); 
                        $(".dropdown-menu").show();
                    },
                    error: function(error) {
                        $("#CargaGif").hide();
                        console.log(error);
                        alert("Algo salio mal :S");
                    }
                });
                return false;
            }

            $(document).on("click touchstart",".dropdown-menu li a",function(){
                var infocliente = $( this ).text();
                var idcliente = $( this ).attr("id");
                $("#btninfocliente").text( idcliente + "-" + infocliente );
                $("#TxtClave").val( idcliente );
                $(".dropdown-menu").hide();
            });
            
            $(document).on("click touchstart","#btninfocliente",function(){
                $("#btninfocliente").text( "Info. cliente");
                $("#TxtCliente").text( "");
                $("#TxtCliente").val("");
                $("#TxtClave").val( 0 );
                $(".dropdown-menu").hide();
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
        { data: "sucursal", 'width':'60px'},
        { data: "id_cliente", 'width':'40px'},
        { data: "cliente", 'width':'180px'},
        { data: "folio", 'width':'60px'},
        { data: "importe", 'width':'60px'},
        
        { data: "iva", 'width':'60px'},
        { data: "total", 'width':'60px'},
        { data: "fechafact", 'width':'60px'},
        { data: "fechavence", 'width':'60px'},
        { data: "fechapago", 'width':'60px'},
        
        { data: "DC", 'width':'30px'},
        { data: "DV", 'width':'30px'},
        { data: "montofactura", 'width':'60px'},
        { data: "montopago", 'width':'60px'},
        { data: "saldofactura", 'width':'60px'},
        
        { data: "tipodocto", 'width':'60px'},
        { data: "moneda", 'width':'60px'}
    ];

    cabeceras1 = [
        { "title": "SUCURSAL", 'width':'60px', className: "text-left", "targets": 0},
        { "title": "ID", 'width':'40px', className: "text-left", "targets": 1},
        { "title": "CLIENTE", 'width':'180px', className: "text-left", "targets": 2},
        { "title": "FOLIO", 'width':'60px', className: "text-right", "targets": 3},
        { "title": "IMPORTE", 'width':'60px', className: "text-right", "targets": 4},
        
        { "title": "IVA", 'width':'60px', className: "text-right", "targets": 5},
        { "title": "TOTAL", 'width':'60px', className: "text-right", "targets": 6},
        { "title": "F.FACTURA", 'width':'60px', className: "text-center", "targets": 7},
        { "title": "F.VENCE", 'width':'60px', className: "text-center", "targets": 8},
        { "title": "F.PAGO", 'width':'60px', className: "text-center", "targets": 9},
        
        { "title": "DC", 'width':'30px', className: "text-right", "targets": 10},
        { "title": "DV", 'width':'30px', className: "text-right", "targets": 11},
        { "title": "MONTO FACT.", 'width':'60px', className: "text-right", "targets": 12},
        { "title": "MONTO PAGO", 'width':'60px', className: "text-right", "targets": 13},
        { "title": "SALDO FACT.", 'width':'60px', className: "text-right", "targets": 14},
        
        { "title": "TIPODOC.", 'width':'60px', className: "text-right", "targets": 15},
        { "title": "MONEDA", 'width':'60px', className: "text-right", "targets": 16}
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
            var api_iva = this.api(), data;
            var api_importe = this.api(), data;
            var api_total = this.api(), data;            
            var api_montofact = this.api(), data;
            var api_montopago = this.api(), data;
            var api_saldofact = this.api(), data;


            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,-]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

                        // Total over all pages
            total_importe = api_importe
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;
            $( api_importe.column( 4 ).footer() ).html(numFormat(total_importe.toFixed(2)) );
                        // Total over all pages
            total_iva = api_iva
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;
            $( api_iva.column( 5 ).footer() ).html(numFormat(total_iva.toFixed(2)) );
                        // Total over all pages
            total_total = api_total
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;
            $( api_total.column( 6 ).footer() ).html(numFormat(total_total.toFixed(2)) );
            // Total over all pages
            total_montofact = api_montofact
                .column( 12 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;
            $( api_montofact.column( 12 ).footer() ).html(numFormat(total_montofact.toFixed(2)) );
            
             // Total over all pages
            total_montopago = api_montopago
                .column( 14 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api_montopago.column( 14 ).footer() ).html(numFormat(total_montopago.toFixed(2)) );   
            
            // Total over all pages
            total_saldofact = api_saldofact
                .column( 15 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;
            $( api_saldofact.column( 15 ).footer() ).html(numFormat(total_saldofact.toFixed(2)) );
            
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
                url: 'con-trayfactpago.php',
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
