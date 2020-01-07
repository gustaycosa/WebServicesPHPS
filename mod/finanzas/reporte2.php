<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Facturas pendientes');?>

<body>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 id="cabecera">
                Facturas Pendientes
            </h6>
        </div>
        <div class="panel-body">
            <form id="formulario" method="POST" class="form-inline">
                <input type="hidden" class="form-control" id="TxtUser" name="TxtUser" value="<?php $id = $_GET["e"]; echo $id;?>" >    
                <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
                <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="0">
                <input type="hidden" class="form-control" id="TxtRow" name="TxtRow" value="">
                <input type="hidden" class="form-control" id="TxtMov" name="TxtMov" value="">
                <div class="form-group">
                    <label for="inputtext3" class="col-sm-3 control-label">Sucursal:</label>
                    <div class="col-sm-9 ">
                        <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES", $emp); ?>
                    </div>
                </div>
                <div class="input-group">
                    <?php echo CmbClientes(); ?>
                </div>
                <div class="form-group">
                    <label for="inputFechaIni">De:</label>
                    <input type="date" name="Fini" id="Fini" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Rango Fecha Inicial" />
                </div>
                <div class="form-group">
                    <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
                </div>

            </form>
            <div class="table-responsive">
                <table id='grid' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;">
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
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
            {data: "Nombre",'width': '210px'},
            {data: "id_sucursal",'width': '60px'},
            {data: "fecha",'width': '30px', type: 'date-euro'},
            {data: "tipodoc",'width': '50px'},
            {data: "numero",'width': '20px'},
            {data: "serie",'width': '20px'},
            {data: "fechavence",'width': '30px', type: 'date-euro'},
            {data: "total",'width': '60px'},
            {data: "saldodocto",'width': '60px'},
            {data: "saldoafecha",'width': '60px'},
            {data: "c_Moneda",'width': '30px'}
        ];
        cabeceras1 = [{
                "title": "NOMBRE",
                'width': '210px',
                className: "text-left",
                "targets": 0
            },
            {
                "title": "SUCURSAL",
                'width': '60px',
                className: "text-left",
                "targets": 1
            },
            {
                "title": "FECHA",
                'width': '30px',
                className: "text-left",
                type: 'date-euro',
                "targets": 2
            },
            {
                "title": "TIPO DOC.",
                'width': '50px',
                className: "text-left",
                "targets": 3
            },
            {
                "title": "FOLIO",
                'width': '20px',
                className: "text-left",
                "targets": 4
            },
            {
                "title": "SERIE",
                'width': '20px',
                className: "text-left",
                "targets": 5
            },
            {
                "title": "VENCE",
                'width': '30px',
                className: "text-left",
                type: 'date-euro',
                "targets": 6
            },
            {
                "title": "TOTAL",
                'width': '70px',
                className: "text-right",
                "targets": 7
            },
            {
                "title": "SALD DOC.",
                'width': '70px',
                className: "text-right",
                "targets": 8
            },
            {
                "title": "SALDO A FECHA",
                'width': '70px',
                className: "text-right",
                "targets": 9
            },
            {
                "title": "MONEDA",
                'width': '30px',
                className: "text-left",
                "targets": 10
            }

        ];
        var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function(row, data, index) {
                if( ! table.data().any()){   
                    $('#grid1').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({id: data.id_cliente});
                }
            },
            dom: 'lfBrtip',
            paging: false,
            searching: true,
            ordering: true,
            buttons: [{
                extend: 'csvHtml5',
                charset: 'UTF-8',
                bom: true,
                text: 'CSV',
                filename: '<?php echo "facturaspend_".date('Y-m-d');?>',
                extension: '.csv',
                exportOptions: {
                    columns: ':visible',
                    modifier: {
                        page: 'all'
                    }
                }
            }, ],
            'pagingType': 'full_numbers',
            'lengthMenu': [
                [-1],
                ['Todo']
            ],
            'language': {
                'sProcessing': 'Procesando...',
                'sLengthMenu': 'Mostrar _MENU_ registros',
                'sZeroRecords': 'No se encontraron resultados',
                'sEmptyTable': 'Ningún dato disponible en esta tabla',
                'sInfo': 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
                'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
                'sInfoPostFix': '',
                'sSearch': 'Buscar:',
                'sUrl': '',
                'sInfoThousands': ',',
                'sLoadingRecords': 'Cargando...',
                'oPaginate': {
                    'sFirst': 'Primero',
                    'sLast': 'Último',
                    'sNext': 'Siguiente',
                    'sPrevious': 'Anterior'
                },
                'oAria': {
                    'sSortAscending': ': Activar para ordenar la columna de manera ascendente',
                    'sSortDescending': ': Activar para ordenar la columna de manera descendente'
                }
            },
            'scrollY': '60vh',
            'scrollCollapse': true,
            'scrollX': false,
            'paging': false,
            fixedHeader: {
                header: true,
                footer: true
            },
            'responsive': true,
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;
                var api_total = this.api(),
                    data;

                var api_facturado = this.api(),
                    data;
                var api_descuentos = this.api(),
                    data;
                var api_devolucion = this.api(),
                    data;
                var api_drefacturacion = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };
                var numFormat = $.fn.dataTable.render.number('\,', '.', 2, '$').display;
                // Total over all pages
                total_drefacturacion = api_drefacturacion
                    .column(7)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_drefacturacion.column(7).footer()).html(numFormat(total_drefacturacion.toFixed(2)));

                // Total over all pages
                total_descuentos = api_descuentos
                    .column(8)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_descuentos.column(8).footer()).html(numFormat(total_descuentos.toFixed(2)));

                // Total over all pages
                total_devolucion = api_devolucion
                    .column(9)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_devolucion.column(9).footer()).html(numFormat(total_devolucion.toFixed(2)));
            }
        }

        $('#txtbusqueda').on('keyup change', function() {
            //clear global search values
            //table.search(this.value).draw();
            table.column(0).search(this.value).draw();
        });

        //    $(".dataTables_filter input").on('keyup change', function() {
        //      //clear column search values
        //      table.columns().search('');
        //      //clear input values
        //      $('#txtbusqueda').val('');
        //    });
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
                url: 'con-reporte2.php',
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
