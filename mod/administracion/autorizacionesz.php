<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Autorizaciones');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            Autorizaciones
        </h6>
    </div>
    <div class="panel-body">
        <form id="formulario" method="POST" class="form-inline">
           <input type="hidden" class="form-control" id="TxtEjercicio" name="TxtEjercicio" value="<?php $id = $_GET["e"]; echo $id;?>" >    
            <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
            <input type="hidden" class="form-control" id="TxtRow" name="TxtRow" value="" > 
            <input type="hidden" class="form-control" id="TxtMov" name="TxtMov" value="" > 
            <div class="col-sm-6 ">
                <label for="inputtext3" class="col-sm-3 control-label">Estatus:</label>
                <div class="col-sm-9">
                    <select id="CmbEstatus" name="CmbEstatus" class="col-sm-12 form-control">
                        <option value="TODOS">TODO</option>
                        <option class="col-sm-12" value="AUTORIZADO">AUTORIZADO</option>
                        <option class="col-sm-12" value="PENDIENTE" selected>PENDIENTE</option>
                        <option class="col-sm-12" value="RECHAZADO">RECHAZADO</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 ">
                <label for="inputtext3" class="col-sm-3 control-label">Sucursal:</label>
                <div class="col-sm-9 ">
                   <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES"); ?>
                </div>
            </div>
            <div class="col-sm-6 ">
                <label for="inputtext3" class="col-sm-3 control-label">Solicitante:</label>
                <div class="col-sm-9 ">
                    <?php echo CmbCualquieras('ID','NOMBRE',"NOMBRESUSUARIOWEB"); ?>
                </div>
            </div>
            <div class="col-sm-6 ">
                <label for="inputtext3" class="col-sm-3 control-label">Depto gasto:</label>
                <div class="col-sm-9">
                    <select id="CmbDepto" name="CmbDepto" class="col-sm-12 form-control">
                        <option value="TODOS">TODO</option>
                        <option class="col-sm-12" value="GASTOS">GASTOS</option>
                        <option class="col-sm-12" value="PENDIENTE">PENDIENTE</option>
                        <option class="col-sm-12" value="RECHAZADO">RECHAZADO</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 ">
                <label for="inputtext3" class="col-sm-3 control-label">Periodo fecha:</label>
                <div class="col-sm-9 ">
                    <?php echo TxtDateRango(); ?>
                </div>
            </div>
            <div class="col-sm-6 ">
                <label for="inputtext3" class="col-sm-3 control-label">elemento:</label>
                <div id="ArrayCap" class="col-sm-9 ">

                </div>
            </div>
            <div class="col-sm-12 ">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver="">Consultar</button>
                <button type="button" id="btnNuevo" class="btn btn-primary btn-sm" onMouseOver="" data-toggle="modal" data-target="#mdlnvo">Nuevo</button>
            </div>

        </form>
        <div class="respuesta">
            <table id='grid' class='table table-bordered table-condensed table-hover display compact' style="width:100%;"></table>
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
            <?php echo JqueryButtons();?>   
        });
        $(function() {
            $("form").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'con-autorizaciones.php',
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
        $(document).on('click','td.autok',function(){
            var id = $(this).parent().attr("id");
            var mov = $(this).parent().attr("mov");
            $("#TxtRow").val(id);
            $("#TxtMov").val(mov);
            $('#CargaGif').show();
            $.ajax({
                type: "POST",
                url: 'con-btnautok.php',
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
                url: 'con-btnautcn.php',
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

    datos1 = [
        { data: "id_autorizacion" },
        { data: "FechaSolicitud" },
        { data: "FechaPedido" },
        { data: "Pedido" },
        { data: "CONCEPTO" },
        { data: "NomSolicita" },
        { data: "total" },
        { data: "autorizado" },
        { "className": 'autok', "orderable": false, "data":'', "defaultContent":'AUTORIZAR'},
        { "className": 'autcn', "orderable": false, "data":'', "defaultContent":'RECHAZAR'},
    ];
    cabeceras1 = [
        { "title": "ID", 'width':'60px', className: "text-left", "targets": 0},
        { "title": "FECHA", 'width':'60px', className: "text-left", "targets": 1},
        { "title": "FECHA PEDIDO", 'width':'60px', className: "text-left", "targets": 2},
        { "title": "PEDIDO", 'width':'60px', className: "text-left", "targets": 3},
        { "title": "CONCEPTO", 'width':'150px', className: "text-left", "targets": 4},
        { "title": "SOLICITA", 'width':'60px', className: "text-left", "targets": 5},
        { "title": "TOTAL", 'width':'60px', className: "text-right", "targets": 6},
        { "title": "ESTATUS", 'width':'60px', className: "text-left", "targets": 7},
        { "title": "", 'width':'60px', className: "text-right", "targets": 8},
        { "title": "", 'width':'60px', className: "text-left", "targets": 9}

    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){

                        $(row).attr({ id:data.id_autorizacion,mov:data.Pedido});
                        $(row).find('.autok').addClass('btn-success');
                        $(row).find('.autcn').addClass('btn-danger');

                        var a = data.autorizado;
                        if( a == 'PENDIENTE'){
                            $(row).addClass('bg-warning');
                        }
                        else if ( a == 'AUTORIZADO'){
                            $(row).addClass('bg-success');
                            $(row).children('td.autcn').text('');
                            $(row).children('td.autok').text('');
                            $(row).children().removeClass(' autcn').removeClass(' autok').removeClass('btn-success').removeClass('btn-danger');
                        }
                        else{
                            $(row).addClass('bg-danger');
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
    var table = $('#grid').DataTable(grid1);

    $('#CargaGif').show();
    $('#btnEnviar2').click();
});
</script>
</html>
