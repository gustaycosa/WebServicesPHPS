<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('FACTURACION DIARIA DETALLE');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            FACTURACION DIARIA DETALLE
        </h6>
    </div>
    <div class="panel-body">
        <form id="formulario" method="POST" class="form-inline">
            <input type="hidden" class="form-control" id="TxtEjercicio" name="TxtEjercicio" value="<?php $id = $_GET["e"]; echo $id;?>" >    
            <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
            <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="0" > 
            <input type="hidden" class="form-control" id="TxtRow" name="TxtRow" value="" > 
            <input type="hidden" class="form-control" id="TxtMov" name="TxtMov" value="" > 
            <div class="form-group">
                <label for="inputtext3" class="col-sm-3 control-label">Vendedor:</label>
                <div class="col-sm-9 ">
                    <?php echo CmbCualquieras('id_vendedor','nombre',"vendedores", $emp); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputtext3" class="col-sm-3 control-label">Sucursal:</label>
                <div class="col-sm-9 ">
                    <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES", $emp); ?>
                </div>
            </div>
            <div class="input-group">
                    <?php echo CmbClientes(); ?>
            </div>
            <div class="input-group">
                <label for="inputtext3" class="col-sm-3 control-label">Tipo:</label>
                <div class="col-sm-9 ">
                    <select id="cmbseries" name="cmbseries" class="form-control">
                        <option value="">TODOS</option>
                        <option value="FACT">FACT</option>
                        <option value="CC1">CC1</option>
                        <option value="FSI">FSI</option>
                    </select>
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
                <label for="inputFechaIni">De:</label>
                <input type="date" name="Ffin" id="Ffin" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Rango Fecha Inicial"/>
                <input type="date" name="Fini" id="Fini" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Rango Fecha Inicial"/>
            </div>
            <div class="form-group">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
            </div>

        </form>
        
<!--        <div class="table-responsive">
            <table id='gridtotales'  class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <thead>
                    <tr>
                        <th>TOTAL FACTURA</th>
                        <th>SALDO DE HOY</th>
                        <th>SALDO A FECHA</th>
                        <th>SIN VENCER</th>
                        <th>1-15</th>
                        <th>16-30</th>
                        <th>31-45</th>
                        <th>46-60</th>
                        <th>61-90</th>
                        <th>91-120</th>
                        <th>MAYOR-120</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="tdtotal" class="text-right"></td>
                        <td id="tdsaldohoy" class="text-right"></td>
                        <td id="tdsaldofecha" class="text-right"></td>
                        <td id="tdsinvencer" class="text-right"></td>
                        <td id="td1-15" class="text-right"></td>
                        <td id="td16-30" class="text-right"></td>
                        <td id="td31-45" class="text-right"></td>
                        <td id="td46-60" class="text-right"></td>
                        <td id="td61-90" class="text-right"></td>
                        <td id="td91-120" class="text-right"></td>
                        <td id="tdmayor120" class="text-right"></td>
                    </tr>
                </tbody>
            </table>
        </div>   -->
        
        <div class="table-responsive">
            <table id='grid'  class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th>
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
        { data: "sucursal", 'width':'80px' },
        { data: "fecha", 'width':'50px' },
        { data: "ano", 'width':'30px' },
        { data: "mes", 'width':'30px' },
        { data: "dia", 'width':'30px' },
        
        { data: "ano_mes", 'width':'30px' },
        { data: "id_vendedor", 'width':'30px' },
        { data: "vendedor", 'width':'160px' },
        { data: "id_cliente", 'width':'30px' },
        { data: "cliente", 'width':'160px' },

        { data: "division", 'width':'60px' },
        { data: "depto", 'width':'60px' },
        { data: "familia", 'width':'60px' },
        { data: "articulo", 'width':'60px' },
        { data: "descripcion", 'width':'180px'},
        
        { data: "unidad_vta",'width':'60px' },
        { data: "tipodocto", 'width':'60px' },
        //{ data: "Tipo_Pago", 'width':'60px' },
        { data: "folio", 'width':'30px' },
        { data: "cantidad", 'width':'60px' },

        { data: "factor", 'width':'60px' },
        { data: "litros", 'width':'60px' },
        { data: "precio", 'width':'60px' },
        { data: "iva", 'width':'30px' },
        { data: "importe_con_iva", 'width':'60px' },
        
        { data: "importe_sin_iva", 'width':'60px' },
        { data: "estatus", 'width':'60px' },
        //{ data: "Fecha_Cancelacion", 'width':'60px' },

    ];
    cabeceras1 = [
        { "title": "SUCURSAL", 'width':'80px', className: "text-left", "targets": 0},
        { "title": "FECHA", 'width':'50px', className: "text-left", "targets": 1},
        { "title": "AÑO", 'width':'30px', className: "text-center", "targets": 2},
        { "title": "MES", 'width':'30px', className: "text-left", "targets": 3},
        { "title": "DIA", 'width':'30px', className: "text-left", "targets": 4},
        
        { "title": "AÑO-MES", 'width':'30px', className: "text-left", "targets": 5},
        { "title": "ID VENDEDOR", 'width':'30px', className: "text-left", "targets": 6},
        { "title": "VENDEDOR", 'width':'160px', className: "text-left", "targets": 7},
        { "title": "ID CLIENTE", 'width':'30px', className: "text-left", "targets": 8},
        { "title": "CLIENTE", 'width':'160px', className: "text-left", "targets": 9},
        
        { "title": "DIVISION", 'width':'60px', className: "text-left", "targets": 10},
        { "title": "DEPTO", 'width':'60px', className: "text-left", "targets": 11},
        { "title": "FAMILIA", 'width':'60px', className: "text-left", "targets": 12},
        { "title": "ARTICULO", 'width':'60px', className: "text-left", "targets": 13},
        { "title": "DESCRIPCION", 'width':'180px', className: "text-left", "targets": 14},
        
        { "title": "UNIDAD VENTA", 'width':'60px', className: "text-left", "targets": 15},
        { "title": "TIPODOCTO", 'width':'60px', className: "text-left", "targets": 16},
        { "title": "FOLIO", 'width':'30px', className: "text-left", "targets": 17},
        { "title": "CANTIDAD", 'width':'60px', className: "text-right", "targets": 18},
        
        { "title": "FACTOR", 'width':'60px', className: "text-right", "targets": 19},
        { "title": "LITROS", 'width':'60px', className: "text-right", "targets": 20},
        { "title": "PRECIO", 'width':'60px', className: "text-right", "targets": 21},
        { "title": "IVA", 'width':'30px', className: "text-right", "targets": 22},
        { "title": "IMPORTE C/IVA", 'width':'60px', className: "text-right", "targets": 23},
        
        { "title": "IMPORTE SIN/IVA", 'width':'60px', className: "text-right", "targets": 24},
        { "title": "ESTATUS", 'width':'60px', className: "text-left", "targets": 25},
    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
                if( ! table.data().any()){   
                    $('#grid').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.id_cliente});
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
                var intFormat = $.fn.dataTable.render.number( '\,', '.', 2, '' ).display;
                 // Total over all pages
                total_totalfact = api_totalfact
                    .column( 18 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_totalfact.column( 18 ).footer() ).html(intFormat(total_totalfact.toFixed(2)) );   
                //$("#tdtotal").html(numFormat(total_totalfact.toFixed(2)));
                 // Total over all pages
                total_saldohoy = api_saldohoy
                    .column( 20 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldohoy.column( 20 ).footer() ).html(intFormat(total_saldohoy.toFixed(2)) );   
                //$("#tdsaldohoy").html(numFormat(total_saldohoy.toFixed(2)));                
                 // Total over all pages
                total_saldoafecha = api_saldoafecha
                    .column( 23 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_saldoafecha.column( 23 ).footer() ).html(numFormat(total_saldoafecha.toFixed(2)) );   
                //$("#tdsaldofecha").html(numFormat(total_saldoafecha.toFixed(2)));                
                 // Total over all pages
                total_sinvencer = api_sinvencer
                    .column( 24 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api_sinvencer.column( 24 ).footer() ).html(numFormat(total_sinvencer.toFixed(2)) );
                //$("#tdsinvencer").html(numFormat(total_sinvencer.toFixed(2)));                
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
                url: 'con-factdiariadet.php',
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
