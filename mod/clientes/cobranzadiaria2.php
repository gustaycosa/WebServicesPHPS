<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Cobranza diaria');?>

<body>
    <div class="panel panel-default">
       <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
            <h6 id="cabecera">
                Cobranza Diaria
            </h6>
        </div>
        <div class="panel-body">
            <form id="formulario" method="POST" class="form-inline">
                <input type="hidden" class="form-control" id="TxtUser" name="TxtUser" value="<?php $id = $_GET["e"]; echo $id;?>" > 
                <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
                <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="0">
                <input type="hidden" class="form-control" id="TxtSuc" name="TxtSuc" value="0">
                <div class="form-group">
                    <label for="inputtext3" class="col-sm-3 control-label">Sucursal:</label>
                    <div class="col-sm-9 ">
                        <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES", $emp); ?>
                    </div>
                </div>
                <div class="input-group" style='display:none;'>
                    <?php echo CmbClientes(); ?>
                </div>
                <div class="input-group">
                    <label for="inputtext3" class="col-sm-3 control-label">Estatus:</label>
                    <div class="col-sm-9 ">
                        <select id="CmbEstatus" name="CmbEstatus" class="form-control">
                            <option value="0">TODOS</option>
                            <option value="CAPTURA">CAPTURA</option>
                            <option value="ACTUALIZAD">ACTUALIZAD</option>
                            <option value="CANCELADO">CANCELADO</option>
                        </select>
                    </div>
                </div>
                <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                    <span class="input-group-addon">De:</span>
                    <input type="date" name="Ffin" id="Ffin" value="<?php echo date("Y"."-"."m"."-"."01");?>" class="form-control" placeholder="Rango Fecha Final">
                </div>
                <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                    <span class="input-group-addon">A:</span>
                    <input type="date" name="Fini" id="Fini" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Rango Fecha Inicial">
                </div>            
                <!--            
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">Ejercicio:</span>
                <input type="text" class="form-control" id="TxtEjercicio" name="TxtEjercicio" value="2019" placeholder="Ingrese ejercicio">
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">Mes:</span>
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
-->
                <div class="form-group">
                    <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
                </div>
            </form>
            <div class="table-responsive col-sm-6 ">
                <table id='grid' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;">
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
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div id="chartcolumnas" class="col-sm-6 row" style="height:450px;margin: 0px auto; "></div>

            <div class="table-responsive col-sm-6 ">
                <table id='grid2' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;">
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <div class='form-inline col-sm-12 row'>
                    <input type="text" class="form-control" id="txtbusqueda" name="txtbusqueda" value="" placeholder="Busqueda general">
                    <button type="button" id="btnCSV" class="btn btn-success btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Descargar Excel CSV</button>
                </div>
            </div>
            <?php echo CargaGif();?>
        </div>
    </div>



</body>

<?php echo Script();?>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

<script type="text/javascript">
    var timer = 0;
    var id = 0;
    var t_ene = 0;
    var t_feb = 0;
    var t_mar = 0;
    var t_abr = 0;
    
    var t_may = 0;
    var t_jun = 0;
    var t_jul = 0;
    var t_ago = 0;
    
    var t_sep = 0;
    var t_oct = 0;
    var t_nov = 0;
    var t_dic = 0;
    
    $(function() {
        <?php 
                echo JqueryButtons();
                echo JqueryCmbClientes();
            ?>
    });
//dt.columns(0).visible(!$(this).is(':checked'))
    $(document).ready(function() {
        var dataPoints = [];
        var countData = 0;
        var chartCol = new CanvasJS.Chart("chartcolumnas", {
            exportEnabled: true,
            animationEnabled: true,
            theme: "light2",
            axisX:{
               labelFontSize: 10,
            },
            title: {
                text: "COBRANZA"
            },
            data: [{
                type: "spline",
                click: onClick,
                dataPoints: dataPoints
            }]
        });

        function addDataCol(data) {
            //dataPoints = [];
            //chartCol.render();
            countData = data.length;
            for (var i = 0; i < data.length; i++) {
                dataPoints.push({
                    label: data[i].label,
                    y: data[i].y,
                });
            }
            var tipo = '';
            if ($('#CmbSUCURSALES :selected').val() == 0) {
                tipo = 'column';
            } else {
                tipo = 'column';
            }
            chartCol.data[0].set("type", tipo);
            chartCol.render();
            chartCol.title.set('text', 'COBRANZA' + ' ' + $('#CmbSUCURSALES :selected').text());
            //dataPoints.pop();
            console.log(dataPoints);
        }

        function emptyArrey(data) {
            //dataPoints = [];
            //chartCol.render();
            for (var i = 0; i < countData; i++) {
                dataPoints.pop();
            }
            chartCol.render();
            console.log(dataPoints);
        }

        function onClick(e) {
            //alert(e.dataPoint.label);
            $('#CargaGif').show();
            var x = e.dataPoint.label;
            var y = 0;
            if (x == 'ENE') {
                y = 1;
                $("#TxtSuc").val(y);
            }
            if (x == 'FEB') {
                y = 2;
                $("#TxtSuc").val(y);
            }
            if (x == 'MAR') {
                //alert('entro');
                y = 3;
                $("#TxtSuc").val(y);
            }
            if (x == 'ABR') {
                y = 4;
                $("#TxtSuc").val(y);
            }
            if (x == 'MAY') {
                y = 5;
                $("#TxtSuc").val(y);
            }
            if (x == 'JUN') {
                y = 6;
                $("#TxtSuc").val(y);
            }
            if (x == 'JUL') {
                y = 7;
                $("#TxtSuc").val(y);
            }
            if (x == 'AGO') {
                y = 8;
                $("#TxtSuc").val(y);
            }
            if (x == 'SEP') {
                y = 9;
                $("#TxtSuc").val(y);
            }
            if (x == 'OCT') {
                y = 10;
                $("#TxtSuc").val(y);
            }
            if (x == 'NOV') {
                y = 11;
                $("#TxtSuc").val(y);
            }
            if (x == 'DIC') {
                y = 12;
                $("#TxtSuc").val(y);
            }
            //alert($("#TxtSuc").val())
            //$('#btnEnviar').attr('disabled', 'disabled');
            var url = '';
            if ($('#CmbSUCURSALES :selected').val() == 0) {
                $("#TxtSuc").val(x);
                url = 'con-reporte3_detsuc.php';
            } else {
                url = 'con-reporte3_det.php';
            }
            $.ajax({
                type: "POST",
                url: url,
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    $('#grid2').dataTable().fnClearTable();
                    $('#grid2').dataTable().fnAddData(res);
                    $('#grid2').DataTable().draw();
                    //$('#chartcolumnas div.canvasjs-chart-container div.canvasjs-chart-canvas').empty();
                    //addchart();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false; // Evitar ejecutar el submit del formulario.
        }

        function addchart() {
            var url = '';
            if ($('#CmbSUCURSALES :selected').val() == 0) {
                url = 'con-grafcobdiaria.php';
            } else {
                url = 'con-grafcobdiaria2.php';
            }
            $('#CargaGif').show();
            $.ajax({
                type: "POST",
                url: url,
                data: $("form").serialize(),
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    var res2 = JSON.parse(data);
                    emptyArrey(res);
                    addDataCol(res);
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false;
        }

        datos1 = [{
                data: "id_sucursal"
            },
            {
                data: "ENE"
            },
            {
                data: "FEB"
            },
            {
                data: "MAR"
            },
            {
                data: "ABR"
            },
            {
                data: "MAY"
            },
            {
                data: "JUN"
            },
            {
                data: "JUL"
            },
            {
                data: "AGO"
            },
            {
                data: "SEP"
            },
            {
                data: "OCT"
            },
            {
                data: "NOV"
            },
            {
                data: "DIC"
            },
            {
                data: "total"
            }
        ];
        cabeceras1 = [{
                "title": "SUCURSAL",
                'width': '80px',
                className: "text-left",
                "targets": 0
            },
            {
                "title": "ENE",
                'width': '70px',
                className: "text-right",
                "targets": 1
            },
            {
                "title": "FEB",
                'width': '70px',
                className: "text-right",
                "targets": 2
            },
            {
                "title": "MAR",
                'width': '70px',
                className: "text-right",
                "targets": 3
            },
            {
                "title": "ABR",
                'width': '70px',
                className: "text-right",
                "targets": 4
            },
            {
                "title": "MAY",
                'width': '70px',
                className: "text-right",
                "targets": 5
            },
            {
                "title": "JUN",
                'width': '70px',
                className: "text-right",
                "targets": 6
            },
            {
                "title": "JUL",
                'width': '70px',
                className: "text-right",
                "targets": 7
            },
            {
                "title": "AGO",
                'width': '70px',
                className: "text-right",
                "targets": 8
            },
            {
                "title": "SEP",
                'width': '70px',
                className: "text-right",
                "targets": 9
            },
            {
                "title": "OCT",
                'width': '70px',
                className: "text-right",
                "targets": 10
            },
            {
                "title": "NOV",
                'width': '70px',
                className: "text-right",
                "targets": 11
            },
            {
                "title": "DIC",
                'width': '70px',
                className: "text-right",
                "targets": 12
            },
            {
                "title": "TOTAL",
                'width': '70px',
                className: "text-right",
                "targets": 13
            },
        ];
        var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function(row, data, index) {
                if (!table.data().any()) {
                    $('#grid1').dataTable().fnClearTable();
                } else {}
            },
            dom: 'lfBrtip',
            paging: false,
            searching: true,
            ordering: true,
            buttons: [{
                extend: 'csvHtml5',
                charset: 'UTF-8',
                bom: true,
                text: 'csv',
                filename: '<?php echo "cobranzadiaria_".date('Y-m-d');?>',
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
            'scrollX': true,
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

                var api_ene = this.api(),
                    data;
                var api_feb = this.api(),
                    data;
                var api_mar = this.api(),
                    data;
                var api_abr = this.api(),
                    data;
                var api_may = this.api(),
                    data;
                var api_jun = this.api(),
                    data;
                var api_jul = this.api(),
                    data;
                var api_ago = this.api(),
                    data;
                var api_sep = this.api(),
                    data;
                var api_oct = this.api(),
                    data;
                var api_nov = this.api(),
                    data;
                var api_dic = this.api(),
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
                t_ene = api_ene
                    .column(1)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_ene.column(1).footer()).html(numFormat(t_ene.toFixed(2)));
//                if (t_ene == 0) {
//                    table.column(1).visible('false');
//                } else {
//                    table.column(1).visible('true');
//                }
                // Total over all pages
                t_feb = api_feb
                    .column(2)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_feb.column(2).footer()).html(numFormat(t_feb.toFixed(2)));
                // Total over all pages
                t_mar = api_mar
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_mar.column(3).footer()).html(numFormat(t_mar.toFixed(2)));
                // Total over all pages
                t_abr = api_abr
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_abr.column(4).footer()).html(numFormat(t_abr.toFixed(2)));
                // Total over all pages
                t_may = api_may
                    .column(5)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_may.column(5).footer()).html(numFormat(t_may.toFixed(2)));
                // Total over all pages
                t_jun = api_jun
                    .column(6)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_jun.column(6).footer()).html(numFormat(t_jun.toFixed(2)));
                // Total over all pages
                t_jul = api_jul
                    .column(7)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_jul.column(7).footer()).html(numFormat(t_jul.toFixed(2)));
                // Total over all pages
                t_ago = api_ago
                    .column(8)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_ago.column(8).footer()).html(numFormat(t_ago.toFixed(2)));
                // Total over all pages
                t_sep = api_sep
                    .column(9)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_sep.column(9).footer()).html(numFormat(t_sep.toFixed(2)));
                // Total over all pages
                t_oct = api_oct
                    .column(10)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_oct.column(10).footer()).html(numFormat(t_oct.toFixed(2)));
                // Total over all pages
                t_nov = api_nov
                    .column(11)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_nov.column(11).footer()).html(numFormat(t_nov.toFixed(2)));
                // Total over all pages
                t_dic = api_dic
                    .column(12)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_dic.column(12).footer()).html(numFormat(t_dic.toFixed(2)));
                
                total_total = api_total
                    .column( 13 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $( api_total.column( 13 ).footer() ).html(numFormat(total_total.toFixed(2)) ); 
            }
        }

//        $('#txtbusqueda').on('keyup change', function() {
//            //clear global search values
//            table.search('');
//            table.column().search(this.value).draw();
//        });
//
//        $(".dataTables_filter input").on('keyup change', function() {
//            //clear column search values
//            table.columns().search('');
//            //clear input values
//            $('#txtbusqueda').val('');
//        });

        $.fn.dataTable.ext.errMode = 'none';
        var table = $('#grid').DataTable(grid1);
        /////////////////////////////////////////////////////////////////////////////////7
        datos2 = [{
                data: "id_cliente"
            },
            {
                data: "Nombre"
            },
            {
                data: "concepto"
            },
            {
                data: "total"
            }
        ];
        cabeceras2 = [{
                "title": "ID",
                'width': '20px',
                className: "text-center",
                "targets": 0
            },
            {
                "title": "CLIENTE",
                'width': '180px',
                className: "text-left",
                "targets": 1
            },
            {
                "title": "CONCEPTO",
                'width': '100px',
                className: "text-left",
                "targets": 2
            },
            {
                "title": "TOTAL",
                'width': '70px',
                className: "text-right",
                "targets": 3
            }
        ];
        var grid2 = {
            'columns': datos2,
            'columnDefs': cabeceras2,
            'createdRow': function(row, data, index) {
                if (!table2.data().any()) {
                    $('#grid2').dataTable().fnClearTable();
                } else {}
            },
            dom: 'lfBrtip',
            paging: false,
            searching: true,
            ordering: false,
            buttons: [{
                extend: 'csvHtml5',
                charset: 'UTF-8',
                bom: true,
                text: 'csv',
                filename: '<?php echo "cobranzadiaria_".date('Y-m-d');?>',
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
            'scrollY': '30vh',
            'scrollCollapse': true,
            'scrollX': true,
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
                total_descuentos = api_descuentos
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_descuentos.column(3).footer()).html(numFormat(total_descuentos.toFixed(2)));
            }
        }

        $('#txtbusqueda').on('keyup change', function() {
            //clear global search values
            table2.search('');
            table2.search(this.value).draw();
        });

        $(".dataTables_filter input").on('keyup change', function() {
            //clear column search values
            table2.columns().search('');
            //clear input values
            $('#txtbusqueda').val('');
        });

        $.fn.dataTable.ext.errMode = 'none';
        var table2 = $('#grid2').DataTable(grid2);
        ////////////////////////////////////////////////////////////////////////////////////////////
        $(document).on('click', '#btnEnviar2', function(e) {
            e.preventDefault();
            $('#CargaGif').show();
            event.preventDefault();
            //$('#btnEnviar').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: 'con-cobdiaria2.php',
                data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    $('#grid').dataTable().fnClearTable();
                    $('#grid').dataTable().fnAddData(res);
                    $('#grid').DataTable().draw();
                    if (t_ene == 0) {table.column(1).visible(false);} else {table.column(1).visible(true);}
                    if (t_feb == 0) {table.column(2).visible(false);} else {table.column(2).visible(true);}
                    if (t_mar == 0) {table.column(3).visible(false);} else {table.column(3).visible(true);}
                    
                    if (t_abr == 0) {table.column(4).visible(false);} else {table.column(4).visible(true);}
                    if (t_may == 0) {table.column(5).visible(false);} else {table.column(5).visible(true);}
                    if (t_jun == 0) {table.column(6).visible(false);} else {table.column(6).visible(true);}
                    
                    if (t_jul == 0) {table.column(7).visible(false);} else {table.column(7).visible(true);}
                    if (t_ago == 0) {table.column(8).visible(false);} else {table.column(8).visible(true);}
                    if (t_sep == 0) {table.column(9).visible(false);} else {table.column(9).visible(true);}
                    
                    if (t_oct == 0) {table.column(10).visible(false);} else {table.column(10).visible(true);}
                    if (t_nov == 0) {table.column(11).visible(false);} else {table.column(11).visible(true);}
                    if (t_dic == 0) {table.column(12).visible(false);} else {table.column(12).visible(true);}
                    $('#chartcolumnas div.canvasjs-chart-container div.canvasjs-chart-canvas').empty();
                    addchart();
                    //table.column(1).visible(false);
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
