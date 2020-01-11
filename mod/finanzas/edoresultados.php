<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Estado de resultados');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            Estado de resultados
        </h6>
    </div>
    <style>
        #formulario{background: #eee; border-radius:0px;}
    </style>
    <div class="panel-body" style="padding-top:0px;">
        <form id="formulario" method="POST" class="form-inline row">
            <input type="hidden" class="form-control" id="TxtUser" name="TxtUser" value="<?php $id = $_GET["e"]; echo $id;?>" > 
            <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">Ejercicio:</span>
                <input type="text" class="form-control" id="TxtEjercicio" name="TxtEjercicio" value="<?php echo date('Y');?>" placeholder="Ingrese ejercicio">
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
            <div class="form-group">
                <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="" placeholder="Ingrese ejercicio">
            </div>
            <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
        </form>
        <div class="table-responsive row">
            <table id='grid' class='table table-striped table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" ></table>
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
                $('#btnEnviar').attr('disabled');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'con-edoresultados.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        $('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        var res = JSON.parse(data);
                        $('#grid').dataTable().fnClearTable();
                        $('#grid').dataTable().fnAddData(res);
                        $('#grid').DataTable().draw();
                    },
                    error: function(error) {
                        ('#btnEnviar').removeAttr('disabled');
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

    datos1 = [
        { data: "ConceptoCtb", 'width':'280px' },
        { data: "Acumulado_Act", 'width':'65px' },
        { data: "Ene", 'width':'65px' },
        { data: "Feb", 'width':'65px' },
        { data: "Mar", 'width':'65px' },
        { data: "Abr", 'width':'65px' },
        { data: "May", 'width':'65px' },
        { data: "Jun", 'width':'65px' },
        { data: "Jul", 'width':'65px' },
        { data: "Ago", 'width':'65px' },
        { data: "Sep", 'width':'65px' },
        { data: "Oct", 'width':'65px' },
        { data: "Nov", 'width':'65px' },
        { data: "Dic", 'width':'65px' }
    ];
    cabeceras1 = [
        { "title": "NOMBRE", 'width':'180px', className: "text-left", "targets": 0},
        { "title": "ACUMULADO", 'width':'65px', className: "text-right", "targets": 1},
        { "title": "ENERO", 'width':'65px', className: "text-right", "targets": 2},
        { "title": "FEBRERO", 'width':'65px', className: "text-right", "targets": 3},
        { "title": "MARZO", 'width':'65px', className: "text-right", "targets": 4},
        { "title": "ABRIL", 'width':'65px', className: "text-right", "targets": 5},
        { "title": "MAYO", 'width':'65px', className: "text-right", "targets": 6},
        { "title": "JUNIO", 'width':'65px', className: "text-right", "targets": 7},
        { "title": "JULIO", 'width':'65px', className: "text-right", "targets": 8},
        { "title": "AGOSTO", 'width':'65px', className: "text-right", "targets": 9},
        { "title": "SEPTIEMBRE", 'width':'65px', className: "text-right", "targets": 10},
        { "title": "OCTUBRE", 'width':'65px', className: "text-right", "targets": 11},
        { "title": "NOVIEMBRE", 'width':'65px', className: "text-right", "targets": 12},
        { "title": "DICIEMBRE", 'width':'65px', className: "text-right", "targets": 13}
    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
                if( ! table.data().any()){   
                    $('#grid').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.Id_ConceptoCtb,class:data.TF});
                }
            },
            dom: 'lfBrtip', 
            paging: false,
            searching: true,
            ordering: false,
            buttons: [
                {
                    extend: 'csvHtml5',
                    charset: 'UTF-8',
                    bom: true,
                    text: 'csv',
                    filename: '<?php echo "edoresultados_".date('Y-m-d');?>',
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
            'responsive':true
    }; 

    $('#txtbusqueda').on('keyup change', function() {
      //clear global search values
      table.search('');
      table.column().search().draw();
    });

    $(".dataTables_filter input").on('keyup change', function() {
      //clear column search values
      table.columns().search('');
      //clear input values
      $('#txtbusqueda').val('');
    });
    var table = $('#grid').DataTable(grid1);


});
</script>
</html>
