<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Autorizaciones');?>
<body>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 id="cabecera">
            Contabilidad vs Almacen
        </h6>
    </div>
    <div class="panel-body">
        <form id="formulario" method="POST" class="form-inline">
           <input type="hidden" class="form-control" id="TxtEjercicio" name="TxtEjercicio" value="<?php $id = $_GET["e"]; echo $id;?>" >    
            <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
            <input type="hidden" class="form-control" id="TxtRow" name="TxtRow" value="" > 
            <input type="hidden" class="form-control" id="TxtMov" name="TxtMov" value="" > 
            <label for="inputtext3" class="col-sm-3 control-label">Sucursal:</label>
            <div class="col-sm-9 ">
               <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES"); ?>
            </div>
            <div class="form-group">
                <?php echo TxtPeriodo();?>
            </div>
            <div class="form-group">
                <?php echo CmbMes();?>
            </div>
            <div class="col-sm-12 ">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
            </div>
        </form>
        <div class="respuesta">
            <table id='grid' class='table table-bordered table-condensed table-hover display compact' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;"></table>
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
    
        $(function() {
            $("form").on('submit', function(e) {
                $('#CargaGif').show();
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'con-contavsalm.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        $('#CargaGif').hide();
                        var res = JSON.parse(data);
                        $('#grid').dataTable().fnClearTable();
                        $('#grid').dataTable().fnAddData(res);
                        $('#grid').DataTable().draw();
                    },
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
    
$(document).ready(function() {

    datos1 = [
        { data: "DIVISION" },
        { data: "DEPTO" },
        { data: "FAMILIA" },
        { data: "DESCRIPCION" },
        { data: "SALDO_INI_ALMACEN" },
        { data: "TOTAL_ENTRADAS" },
        { data: "TOTAL_SALIDAS" },
        { data: "SALDO_INI_CONTA" },
        { data: "DEBE" },
        { data: "HABER" },
        { data: "SALDO_FIN_CONTA" },
        { data: "DIFERENCIA" },
    ];
    cabeceras1 = [
        { "title": "DIVISION", 'width':'20px', className: "text-left", "targets": 0},
        { "title": "DEPTO", 'width':'30px', className: "text-center", "targets": 1},
        { "title": "FAMILIA", 'width':'30px', className: "text-center", "targets": 2},
        { "title": "DESCRIPCION", 'width':'40px', className: "text-left", "targets": 3},
        { "title": "SALDO_INI_ALMACEN", 'width':'60px', className: "text-left", "targets": 4},
        { "title": "TOTAL_ENTRADAS", 'width':'30px', className: "text-right", "targets": 5},
        { "title": "TOTAL_SALIDAS", 'width':'30px', className: "text-left", "targets": 6},
        { "title": "SALDO_INI_CONTA", 'width':'30px', className: "text-right", "targets": 7},
        { "title": "DEBE", 'width':'30px', className: "text-right", "targets": 8},
        { "title": "HABER", 'width':'30px', className: "text-left", "targets": 9},
        { "title": "SALDO_FIN_CONTA", 'width':'30px', className: "text-right", "targets": 10},
        { "title": "DIFERENCIA", 'width':'30px', className: "text-right", "targets": 11}
    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
                if( ! table.data().any()){   
                    $('#grid').dataTable().fnClearTable();
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
                    extend: 'excel',
                    message: 'PDF creado desde el sistema en linea del tayco.',
                    text: 'XLS',
                    filename: 'vtas_netasfact',
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
            'scrollY': '60vh',
            'scrollCollapse': true,
            'scrollX': true,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true
    }; 

    $('#txtbusqueda').on('keyup change', function() {
      //clear global search values
      table.search('');
      table.column($(this).data('columnIndex')).search(this.value).draw();
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
        $('#CargaGif').show();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'con-contavsalm.php',
            data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
            success: function(data) {
                $('#CargaGif').hide();
                var res = JSON.parse(data);
                $('#grid').dataTable().fnClearTable();
                $('#grid').dataTable().fnAddData(res);
                $('#grid').DataTable().draw();
            },
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
