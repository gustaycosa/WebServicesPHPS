<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include("../../funciones.php");?>
<?php echo Cabecera('Existencias');?>
    <body>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 id="cabecera">
                    Existencias
                </h6>
            </div>
            <div class="panel-body">
                <form id="formulario" method="POST" action="/" class="form-inline">
                    <input type="hidden" class="form-control" id="TxtUser" name="TxtUser" value="<?php $id = $_GET["e"]; echo $id;?>" > 
                    <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
<!--                    <div class="form-group">
                        <?php echo CmbCualquieras('depto','nombre',"deptos"); ?>
                    </div>
                    <div class="form-group">
                        <?php echo CmbCualquieras("division","nombre","divisiones"); ?>
                    </div>
                    <div id="xxx" class="form-group">
                        
                    </div>
                    <div class="form-group">
                        <input type="text" name="Txtfiltro" id="Txtfiltro" value="" class="form-control" placeholder="Palabras clave" />
                    </div>-->
                    <div class="form-group">
                        <input type="submit" id="btnEnviar" name="action" class="btn btn-primary btn-sm" value="Consultar" onMouseOver="" />
                    </div>
                </form>
                <div class="table-responsive">
                    <table id='grid' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                        <tfoot>
                            <tr>
                                <th></th><th></th><th></th><th></th><th></th>
                                <th></th><th></th><th></th><th></th><th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>    
                <div class="form-inline">
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

        $('select#Cmbdivisiones').on('change', function() {
            $.ajax({
                url: 'con-cmbfamilias.php',
                type: 'POST',
                async: true,
                data: $("form").serialize(),
                success: function(data) {
                    $("#xxx").html(data); // Mostrar la respuestas del script PHP.
                },
                error: function(error) {
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
        });

        $('select#Cmbdeptos').on('change', function() {

        });

        $("form").on('submit', function(e) {
            if ($( "#Txtfiltro" ).text = ''){
                $('#btnEnviar').attr('disabled', 'disabled');
            }else{
                $('#btnEnviar').removeAttr('disabled');
                e.preventDefault();
                $('#CargaGif').show();
                $('#btnEnviar').attr('disabled', 'disabled')
                $.ajax({
                    type: "POST",
                    url: 'con-admexistencias.php',
                    data: $("form").serialize(),
                    success: function(data) {
                        $('#CargaGif').hide();
                        var res = JSON.parse(data);
                        $('#grid').dataTable().fnClearTable();
                        $('#grid').dataTable().fnAddData(res);
                        $('#grid').DataTable().columns([0, 3, 4, 5]).every( function () {
                            var column = this;
                            var select = $('<select class="col-sm-12"><option value="">Selecciona</option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                            } );

                            column.data().unique().sort().each( function ( d, j ) {
                                if(j>=0){
                                    select.append( '<option value="'+d+'" width="auto">'+d+'</option>' )
                                }
                                else{
                                }
                            } );
                        } );
                        $('#grid').DataTable().columns([1,2]).every( function () {
                            var that = this;
                            var title = $(this).text();
                            var txt = $('<input type="text" placeholder="Busca por '+title+'" class="col-sm-12" />')
                            .appendTo( $(that.footer()).empty() )
                            $( 'input', this.footer() ).on( 'keyup change', function () {
                                if ( that.search() !== this.value ) {
                                    that
                                        .search( this.value )
                                        .draw();
                                }
                            } );
                        } );
                        $('#grid').DataTable().draw();
                        $('#btnEnviar').removeAttr('disabled');
                    },
                    error: function(error) {
                        $('#CargaGif').hide();
                        $('#btnEnviar').removeAttr('disabled');
                        console.log(error);
                        alert('Algo salio mal :S');
                    }
                });
                return false; // Evitar ejecutar el submit del formulario.
            }
        });
/*    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );*/
 
    // DataTable
    var table = $('#example').DataTable();
 
    // Apply the search
/*    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );*/
    
$(document).ready(function() {

    datos1 = [
        { data: "ID_SUCURSAL", 'width':'60px' },
        { data: "CODIGO", 'width':'60px' },
        { data: "NOMBRE", 'width':'200px' },
        { data: "DIVISION", 'width':'60px' },
        { data: "DEPTO", 'width':'60px' },
        { data: "FAMILIA", 'width':'60px' },
        { data: "EXISTENCIA", 'width':'60px' },
        { data: "disponible", 'width':'60px' },
        { data: "costoultimo", 'width':'60px' },
        { data: "CostoProm" }
    ];
    cabeceras1 = [
        { "title": "SUCURSAL", 'width':'60px', className: "text-left", "targets": 0},
        { "title": "CODIGO ARTICULO", 'width':'60px', className: "text-left", "targets": 1},
        { "title": "NOMBRE", 'width':'150px', className: "text-left", "targets": 2},
        { "title": "DIVISION", 'width':'60px', className: "text-left", "targets": 3},
        { "title": "DEPARTAMENTO", 'width':'60px', className: "text-left", "targets": 4},
        { "title": "FAMILIA", 'width':'60px', className: "text-left", "targets": 5},
        { "title": "EXISTENCIA", 'width':'60px', className: "text-right", "targets": 6},
        { "title": "DISPONIBLE", 'width':'60px', className: "text-right", "targets": 7},
        { "title": "COSTO ULT.", 'width':'60px', className: "text-right", "targets": 8},
        { "title": "COSTO PROM.", 'width':'60px', className: "text-right", "targets": 9},
    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
            },
            //dom: 'lfBrtip', 
            dom: 'B<"clear">lfrtip',
            paging: false,
            searching: true,
            ordering: true,
            buttons: [
                {
                    extend: 'csvHtml5',
                    message: 'PDF creado desde el sistema en linea del tayco.',
                    text: 'CSV',
                    filename: '<?php echo "existencias".date('Y-m-d');?>',
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
                    message: 'PDF creado desde el sistema en linea del tayco.',
                    text: 'PDF',
                    filename: '<?php echo "existencias".date('Y-m-d');?>',
                    extension: '.pdf', 
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                }
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
            'responsive':true/*,
            initComplete: function () {
                this.api().columns().every( function () {
                //this.api().columns([0, 3, 4, 5]).every( function () {
                    var column = this;

                    var select = $('<select><option value="">Selecciona</option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        if(j>1){
                            select.append( '<option value="'+d+'" width="auto">'+d+'</option>' )
                        }
                        else{

                        }
                    } );
                } );
            }*/
    }; 

//    $('#txtbusqueda').on('keyup change', function() {
//      //clear global search values
//      table.search('');
//      table.column($(this).data('columnIndex')).search(this.value).draw();
//    });
//
//    $(".dataTables_filter input").on('keyup change', function() {
//      //clear column search values
//      table.columns().search('');
//      //clear input values
//      $('#txtbusqueda').val('');
//    });
    var table = $('#grid').DataTable(grid1);
    
    $('#CargaGif').show();
    $('#btnEnviar').click();

});

</script>

</html>
