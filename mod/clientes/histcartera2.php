<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Historial cartera graficas');?>

<body>
    <div class="panel panel-default">
       <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
            <h6 id="cabecera">
                Historial cartera graficas
            </h6>
        </div>
        <div class="panel-body">
            <form id="formulario" method="POST" class="form-inline">
                <input type="hidden" class="form-control" id="TxtUser" name="TxtUser" value="<?php $id = $_GET["e"]; echo $id;?>">
                <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>">
                <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="0">
                <input type="hidden" class="form-control" id="TxtSuc" name="TxtSuc" value="0">
                <input type="hidden" class="form-control" id="TxtRow" name="TxtRow" value="">
                <input type="hidden" class="form-control" id="TxtMov" name="TxtMov" value="">
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
                    <input type="date" name="Fini" id="Fini" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Rango Fecha Inicial" />
                </div>
                <div class="form-group">
                    <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
                </div>

            </form>

            <div class="table-responsive">
                <table id='gridtotales' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;">
                    <thead>
                        <tr>
                            <th>REMANENTE</th>
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
                            <td id="tdsremanente" class="text-right"></td>
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
            </div>
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
                        </tr>
                    </tfoot>
                </table>
                <div class='form-inline col-sm-12 row'>
                    <!--<input type="text" class="form-control" id="txtbusqueda" name="txtbusqueda" value="" placeholder="Busqueda general">-->
                    <button type="button" id="btnCSV1" class="btn btn-success btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Descargar Excel CSV</button>
                    <button type="button" id="btnPDF1" class="btn btn-danger btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>Descargar PDF</button>
                </div>
            </div>
            <div id="chartcolumnas" class="col-sm-6 row" style="height:450px;margin: 0px auto; "></div>

            <div class="table-responsive col-sm-10 ">
                <table id='grid2' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;">
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
                        </tr>
                    </tfoot>
                </table>
                <div class='form-inline col-sm-12 row'>
                    <input type="text" class="form-control" id="txtbusqueda" name="txtbusqueda" value="" placeholder="Busqueda general">
                    <button type="button" id="btnCSV2" class="btn btn-success btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Descargar Excel CSV</button>
                    <button type="button" id="btnPDF2" class="btn btn-danger btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>Descargar PDF</button>
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

    $(function() {
        $( "#btnCSV1" ).click(function() {$("#grid_wrapper div.dt-buttons a.buttons-csv").click();});
        $( "#btnPDF1" ).click(function() {$("#grid_wrapper div.dt-buttons a.buttons-pdf").click();});
        $( "#btnCSV2" ).click(function() {$("#grid2_wrapper div.dt-buttons a.buttons-csv").click();});
        $( "#btnPDF2" ).click(function() {$("#grid2_wrapper div.dt-buttons a.buttons-pdf").click();});
        <?php 
                echo JqueryCmbClientes();
            ?>
    });


    $(document).ready(function() {
        var dataPoints = [];
        var chartCol = new CanvasJS.Chart("chartcolumnas", {
            exportEnabled: true,
            animationEnabled: true,
            animationDuration: 2000,
            culture: "es",
            theme: "light2",
            title: {
                text: "Sucursal - Litros vendidos"
            },
            axisX: {
                labelFontSize: 10,
            },
            //        axisY:{
            //            interval: 1000000
            //        },
            data: [{
                type: "column",
                click: onClick,
                dataPoints: dataPoints
            }]
        });

        function addDataCol(data) {
            //dataPoints = [];
            //chartCol.render();
            for (var i = 0; i < data.length; i++) {
                dataPoints.push({
                    label: data[i].label,
                    y: data[i].y,
                });
            }
            chartCol.render();
            chartCol.title.set('text', 'HISTCARTERA' + ' ' + $('#CmbSUCURSALES :selected').text());
            //dataPoints.pop();
            console.log(dataPoints);
        }

        function emptyArrey(data) {
            //dataPoints = [];
            //chartCol.render();
            for (var i = 0; i < data.length; i++) {
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
            var z = 0;
            if (x == 'Remanente') {
                y = 1;
                z = 1;
            }
            if (x == 'Sin Vencer') {
                y = 0;
                z = 0;
            }
            if (x == '1-15') {
                y = 1;
                z = 15;
            }
            if (x == '16-30') {
                y = 16;
                z = 30;
            }
            if (x == '31-45') {
                y = 31;
                z = 45;
            }
            if (x == '46-60') {
                y = 46;
                z = 60;
            }
            if (x == '61-90') {
                y = 61;
                z = 90;
            }
            if (x == '91-120') {
                y = 91;
                z = 120;
            }
            if (x == 'Mayor-120') {
                y = 120;
                z = 120;
            }
            $("#TxtSuc").val(y);
            $("#TxtRow").val(z);
            //alert($("#TxtSuc").val())
            //$('#btnEnviar').attr('disabled', 'disabled');
            var url = '';
            /*        
                    if ($('#CmbSUCURSALES :selected').val() == 0){
                        $("#TxtSuc").val(x);
                        url = 'con-reporte3_detsuc.php';
                    }else{
                        url = 'con-reporte3_det.php';
                    }
            */
            $.ajax({
                type: "POST",
                url: 'con-histcartera_dias.php',
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
            $('#CargaGif').show();
            $.ajax({
                type: "POST",
                url: 'con-histcartera2.php',
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
                data: "Sucursal",
                'width': '60px'
            },
            {
                data: "remanente",
                'width': '70px'
            },
            {
                data: "SinVencer",
                'width': '70px'
            },
            {
                data: "1-15",
                'width': '70px'
            },
            {
                data: "16-30",
                'width': '70px'
            },
            {
                data: "31-45",
                'width': '70px'
            },
            {
                data: "46-60",
                'width': '70px'
            },
            {
                data: "61-90",
                'width': '70px'
            },
            {
                data: "91-120",
                'width': '70px'
            },
            {
                data: "Mayor-120",
                'width': '70px'
            },
            {
                data: "total",
                'width': '70px'
            }
        ];
        cabeceras1 = [{
                "title": "SUCURSAL",
                'width': '60px',
                className: "",
                "targets": 0
            },
            {
                "title": "Remanente",
                'width': '70px',
                className: "text-right",
                "targets": 1
            },
            {
                "title": "Sin Vencer",
                'width': '70px',
                className: "text-right",
                "targets": 2
            },
            {
                "title": "1-15",
                'width': '70px',
                className: "text-right",
                "targets": 3
            },
            {
                "title": "16-30",
                'width': '70px',
                className: "text-right",
                "targets": 4
            },
            {
                "title": "31-45",
                'width': '70px',
                className: "text-right",
                "targets": 5
            },
            {
                "title": "46-60",
                'width': '70px',
                className: "text-right",
                "targets": 6
            },
            {
                "title": "61-90",
                'width': '70px',
                className: "text-right",
                "targets": 7
            },
            {
                "title": "91-120",
                'width': '70px',
                className: "text-right",
                "targets": 8
            },
            {
                "title": "MAYOR-120",
                'width': '70px',
                className: "text-right",
                "targets": 9
            },
            {
                "title": "TOTAL",
                'width': '70px',
                className: "text-right",
                "targets": 10
            }
        ];
        var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function(row, data, index) {
                if (!table1.data().any()) {
                    $('#grid').dataTable().fnClearTable();
                } else {
                    $(row).attr({
                        id: data.Sucursal
                    });
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
                    filename: '<?php echo "histcartera_".date('Y-m-d');?>',
                    extension: '.csv', 
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'landscape',
                    title:'<?php echo "Historial cartera ".date('Y-m-d');?>',
                    filename: '<?php echo "histcartera_".date('Y-m-d');?>',
                    customize: function(doc) {
                        doc.content[1].margin = [ 0, 0, 0, 0 ]; //left, top, right, bottom
                        doc.styles.tableHeader.fontSize = 8;
                        doc.defaultStyle.fontSize = 8;
                    },
                    styles: {
                        tableHeader: {
                            bold: true,
                            fontSize: 11,
                            color: 'white',
                            fillColor: '#2d4154',
                            alignment: 'center'
                        },
                        tableBodyEven: {},
                        tableBodyOdd: {
                            fillColor: '#f3f3f3'
                        },
                        tableFooter: {
                            bold: true,
                            fontSize: 11,
                            color: 'white',
                            fillColor: '#2d4154'
                        },
                        title: {
                            alignment: 'center',
                            fontSize: 15
                        },
                        message: {}
                    },
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },
            ],
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
            'scrollY': '50vh',
            'scrollCollapse': true,
            'scrollX': true,
            'autoWidth': false,
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

                var api_totalfact = this.api(),
                    data;
                var api_saldohoy = this.api(),
                    data;
                var api_saldoafecha = this.api(),
                    data;
                var api_sinvencer = this.api(),
                    data;
                var api_1_15 = this.api(),
                    data;
                var api_16_30 = this.api(),
                    data;
                var api_31_45 = this.api(),
                    data;
                var api_46_60 = this.api(),
                    data;
                var api_61_90 = this.api(),
                    data;
                var api_91_120 = this.api(),
                    data;
                var api_mayor120 = this.api(),
                    data;

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };
                var numFormat = $.fn.dataTable.render.number('\,', '.', 2, '$').display;

                sinvencer = api_sinvencer
                    .column(1)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_sinvencer.column(1).footer()).html(numFormat(sinvencer.toFixed(2)));
                $("#tdsremanente").html(numFormat(sinvencer.toFixed(2)));
                
                sinvencer = api_sinvencer
                    .column(2)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_sinvencer.column(2).footer()).html(numFormat(sinvencer.toFixed(2)));
                $("#tdsinvencer").html(numFormat(sinvencer.toFixed(2)));

                total_1_15 = api_1_15
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_1_15.column(3).footer()).html(numFormat(total_1_15.toFixed(2)));
                $("#td1-15").html(numFormat(total_1_15.toFixed(2)));

                total_16_30 = api_16_30
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_16_30.column(4).footer()).html(numFormat(total_16_30.toFixed(2)));
                $("#td16-30").html(numFormat(total_16_30.toFixed(2)));

                total_31_45 = api_31_45
                    .column(5)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_31_45.column(5).footer()).html(numFormat(total_31_45.toFixed(2)));
                $("#td31-45").html(numFormat(total_31_45.toFixed(2)));

                total_46_60 = api_46_60
                    .column(6)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_46_60.column(6).footer()).html(numFormat(total_46_60.toFixed(2)));
                $("#td46-60").html(numFormat(total_46_60.toFixed(2)));

                total_61_90 = api_61_90
                    .column(7)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_61_90.column(7).footer()).html(numFormat(total_61_90.toFixed(2)));
                $("#td61-90").html(numFormat(total_61_90.toFixed(2)));

                total_91_120 = api_91_120
                    .column(8)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_91_120.column(8).footer()).html(numFormat(total_91_120.toFixed(2)));
                $("#td91-120").html(numFormat(total_91_120.toFixed(2)));

                total_mayor120 = api_mayor120
                    .column(9)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_mayor120.column(9).footer()).html(numFormat(total_mayor120.toFixed(2)));
                $("#tdmayor120").html(numFormat(total_mayor120.toFixed(2)));

                total_total = api_total
                    .column(10)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_total.column(10).footer()).html(numFormat(total_total.toFixed(2)));
                //$("#tdmayor120").html(numFormat(total_total.toFixed(2)));
            }
        }

        //    $('#txtbusqueda').on('keyup change', function() {
        //      table.search('');
        //      table.column().search(this.value).draw();
        //    });
        //
        //    $(".dataTables_filter input").on('keyup change', function() {
        //      table.columns().search('');
        //      $('#txtbusqueda').val('');
        //    });
        $.fn.dataTable.ext.errMode = 'none';
        var table1 = $('#grid').DataTable(grid1);
        /////////////////////////////////////////////////////////////////////////////////7
        datos2 = [{
                data: "Sucursal",
                'width': '60px'
            },
            {
                data: "Id_Cliente",
                'width': '30px'
            },
            {
                data: "Cliente",
                'width': '170px'
            },
            {
                data: "serie",
                'width': '40px'
            },
            {
                data: "Folio",
                'width': '40px'
            },
            {
                data: "concepto",
                'width': '170px'
            },
            {
                data: "FechaFactura",
                type: 'date-euro',
                'width': '60px'
            },
            {
                data: "FechaVence",
                type: 'date-euro',
                'width': '60px'
            },
            {
                data: "dv",
                'width': '20px'
            },

            {
                data: "dc",
                'width': '20px'
            },
            {
                data: "TotalFactura",
                'width': '70px'
            },
            {
                data: "SaldoFechaEspecificada",
                'width': '70px'
            }
        ];
        cabeceras2 = [{
                "title": "SUCURSAL",
                'width': '60px',
                className: "",
                "targets": 0
            },
            {
                "title": "ID",
                'width': '30px',
                className: "text-right",
                "targets": 1
            },
            {
                "title": "CLIENTE",
                'width': '170px',
                className: "text-right",
                "targets": 2
            },
            {
                "title": "SERIE",
                'width': '40px',
                className: "text-right",
                "targets": 3
            },
            {
                "title": "FOLIO",
                'width': '40px',
                className: "text-right",
                "targets": 4
            },

            {
                "title": "CONCEPTO",
                'width': '170px',
                className: "text-left",
                "targets": 5
            },
            {
                "title": "F.FACT",
                'width': '60px',
                className: "text-right",
                type: 'date-euro',
                "targets": 6
            },
            {
                "title": "F.VENCE",
                'width': '60px',
                className: "text-right",
                type: 'date-euro',
                "targets": 7
            },
            {
                "title": "DV",
                'width': '20px',
                className: "text-right",
                "targets": 8
            },
            {
                "title": "DC",
                'width': '20px',
                className: "text-right",
                "targets": 9
            },

            {
                "title": "TOTAL",
                'width': '70px',
                className: "text-right",
                "targets": 10
            },
            {
                "title": "SALDO",
                'width': '70px',
                className: "text-right",
                "targets": 11
            },
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
            ordering: true,
            buttons: [
                {
                    extend: 'csvHtml5',
                    charset: 'UTF-8',
                    bom: true,
                    text: 'CSV',
                    filename: '<?php echo "histcartera_det_".date('Y-m-d');?>',
                    extension: '.csv', 
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'landscape',
                    title:'<?php echo "Historial cartera ".date('Y-m-d');?>',
                    filename: '<?php echo "histcartera_det_".date('Y-m-d');?>',
                    customize: function(doc) {
                        doc.content[1].margin = [ 0, 0, 0, 0 ]; //left, top, right, bottom
                        doc.styles.tableHeader.fontSize = 8;
                        doc.defaultStyle.fontSize = 8;
                    },
                    styles: {
                        tableHeader: {
                            bold: true,
                            fontSize: 11,
                            color: 'white',
                            fillColor: '#2d4154',
                            alignment: 'center'
                        },
                        tableBodyEven: {},
                        tableBodyOdd: {
                            fillColor: '#f3f3f3'
                        },
                        tableFooter: {
                            bold: true,
                            fontSize: 11,
                            color: 'white',
                            fillColor: '#2d4154'
                        },
                        title: {
                            alignment: 'center',
                            fontSize: 15
                        },
                        message: {}
                    },
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },
            ],
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
                    .column(11)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api_descuentos.column(11).footer()).html(numFormat(total_descuentos.toFixed(2)));
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
        ////////////////////////////////////////////////////////////////////////////////////////////////    
        $(document).on('click', '#btnEnviar2', function(e) {
            e.preventDefault();
            $('#CargaGif').show();
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'con-histcartera3.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    $('#grid2').dataTable().fnClearTable();
                    $('#grid2').DataTable().draw();
                    $('#grid').dataTable().fnClearTable();
                    $('#grid').dataTable().fnAddData(res);
                    $('#grid').DataTable().draw();
                    $('#chartcolumnas div.canvasjs-chart-container div.canvasjs-chart-canvas').empty();

                    addchart();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            })
            return false;
        });

        //    $(document).on('click', '#grid tr', function(e) {
        //        chartCol.options.data[0].dataPoints = [];
        //        var id = $(this).attr("id");
        //        $("#CmbSUCURSALES option").val(id);
        //        addchart();
        //    });
    });

</script>

</html>
