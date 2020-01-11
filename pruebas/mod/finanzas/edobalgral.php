<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
    $TituloPantalla = 'Balance General';
    include("../../funciones.php");  
?>
<?php echo Cabecera('Balance general');?>
<body>
    <div class="panel panel-default">
       <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
            <h6 id="cabecera">
                <?php echo $TituloPantalla; ?>
            </h6>
        </div>
        <style>
            .T2{ background: #b3b3b3;}
        </style>
        <div class="panel-body">
            <form id="formulario" method="POST" class="form-inline">
                <input type="hidden" id="TxtClave" name="TxtClave">
                <input type="hidden" class="form-control" id="TxtUser" name="TxtUser" value="<?php $id = $_GET["e"]; echo $id;?>" > 
                <input type="hidden" class="form-control" id="TxtEmpresa" name="TxtEmpresa" value="<?php $emp = $_GET["a"]; echo $emp;?>" >
                <div class="form-group">
                    <?php echo TxtPeriodo();?>
                </div>
                <div class="form-group">
                    <?php echo CmbMes();?>
                </div>
                <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>

            </form> 
            <ol class="breadcrumb" style="margin-bottom:0px;">
                <li><strong id="slvl">Nivel 1</strong></li>
                <li><a id="Titulo1" class="font-weight-bold">BALANCE GENERAL</a></li>
                <li><a id="Titulo2" style="display:none;"></a></li>
                <li><a id="Titulo3" style="display:none;"></a></li>
                <li><a id="Titulo4" style="display:none;"></a></li>
            </ol>
            <div id="lv1" class="lvl table-responsive">
                <table id='grid' class='table table-striped table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                </table>
            </div>
            <div id="lv2" class="lvl table-responsive" style="display:none;">
                <table id='griddet' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" ><tfoot><th></th><th></th><th></th><th></th><th></th></tfoot></table>
            </div>
            <div id="lv3" class="lvl table-responsive" style="display:none;">
                <table id='griddet2' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" ><tfoot><th></th><th></th><th></th><th></th><th></th></tfoot></table>
            </div>
            <div id="lv4" class="lvl table-responsive" style="display:none;">
                <table id='griddet3' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" ><tfoot><th></th><th></th><th></th><th></th><th></th></tfoot></table>
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

    /*
    $(document).on('click touchstart', '#grid tbody tr', function() {

        var id = $(this).attr("id");
        $("#TxtClave").val(id);

        if (timer == 0) {
            timer = 1;
            timer = setTimeout(function() {
                timer = 0;
            }, 600);
        } else {
            //alert("double tap"); 
            var id = $(this).attr("id");
            $("#TxtClave").val(id);
            $('#CargaGif').show();
            //$("#myModalLabel").text('FACTURADO '+id);
            $.ajax({
                type: "POST",
                url: 'con-edobalgral2.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    var res = JSON.parse(data);
                    $('#CargaGif').hide();
                    $('#griddet').dataTable().fnClearTable();
                    $('#griddet').dataTable().fnAddData(res);
                    $('#griddet').DataTable().draw();

                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false; // Evitar ejecutar el submit del formulario.
            timer = 0;
        }
    });

    $(document).on('click touchstart', '#griddet tbody tr', function() {

        var id = $(this).attr("id");
        $("#TxtClave").val(id);

        if (timer == 0) {
            timer = 1;
            timer = setTimeout(function() {
                timer = 0;
            }, 600);
        } else {
            //alert("double tap"); 
            var id = $(this).attr("id");
            $("#TxtClave").val(id);
            $('#CargaGif').show();
            //$("#myModalLabel").text('FACTURADO '+id);
            $.ajax({
                type: "POST",
                url: 'con-edobalgral3.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    var res = JSON.parse(data);
                    $('#CargaGif').hide();
                    $('#griddet2').dataTable().fnClearTable();
                    $('#griddet2').dataTable().fnAddData(res);
                    $('#griddet2').DataTable().draw();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false; // Evitar ejecutar el submit del formulario.
            timer = 0;
        }
    });*/

    $('tr').click(function() {
        $('#grid').DataTable().draw();
    });

    
$(document).ready(function() {
    datos1 = [
        { data: "ConceptoCtb" },
        { data: "Mes_Actual" },
    ];
    cabeceras1 = [
        { "title": "CONCEPTO CONTABLE", 'width':'150px', className: "text-left", "targets": 0},
        { "title": "MES ACTUAL", 'width':'60px', className: "text-right", "targets": 1},
    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
                if( ! table1.data().any()){   
                    $('#grid').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.Id_ConceptoCtb, class:data.TF, mov:data.ConceptoCtb});
                }
            },
            dom: 'fBrt',
            paging: false,
            searching: true,
            ordering: false,
            buttons: [
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    header:'true',
                    filename: 'vtas_netasfact',
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
            'scrollX': false,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true


    }; 
    $.fn.dataTable.ext.errMode = 'none';
    var table1 = $('#grid').DataTable(grid1);
    //////////////////////////////////////////////////////////////////////////////////////
    datos2 = [
        { data: "nombre" },
        { data: "debe",'width':'60px' },
        { data: "haber",'width':'60px' },
        { data: "saldo",'width':'60px' },
        { data: "cfinal",'width':'60px' },
    ];
    cabeceras2 = [
        { "title": "NOMBRE", 'width':'150px', className: "text-left", "targets": 0},
        { "title": "DEBE", 'width':'60px', className: "text-right", "targets": 1},
        { "title": "HABER", 'width':'60px', className: "text-right", "targets": 2},
        { "title": "SALDO", 'width':'60px', className: "text-right", "targets": 3},
        { "title": "COSTO FINAL", 'width':'60px', className: "text-right", "targets": 4}
    ];
    var grid2 = {
            'columns': datos2,
            'columnDefs': cabeceras2,
            'createdRow': function (row,data,index){
                if( ! table2.data().any()){   
                    $('#griddet').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.id_cuentactb, mov:data.nombre, afc:data.afectable});
                }
            },
            dom: 'lfBrtip', 
            paging: false,
            searching: true,
            ordering: true,
            buttons: [
                {
                    extend: 'csvHtml5',
                    message: 'PDF creado desde el sistema en linea del tayco.',
                    text: 'CSV',
                    filename: '<?php echo "edobalgral_".date('Y-m-d');?>',
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
            'scrollY': '50vh',
            'scrollCollapse': true,
            'scrollX': false,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true
    };
    $.fn.dataTable.ext.errMode = 'none';
    var table2 = $('#griddet').DataTable(grid2);
    /////////////////////////////////////////////////////////////////////////////////////////////////
    datos3 = [
        { data: "nombre" },
        { data: "debe",'width':'60px' },
        { data: "haber",'width':'60px' },
        { data: "saldo",'width':'60px' },
        { data: "cfinal",'width':'60px' },
    ];
    cabeceras3 = [
        { "title": "NOMBRE", 'width':'150px', className: "text-left", "targets": 0},
        { "title": "DEBE", 'width':'60px', className: "text-right", "targets": 1},
        { "title": "HABER", 'width':'60px', className: "text-right", "targets": 2},
        { "title": "SALDO", 'width':'60px', className: "text-right", "targets": 3},
        { "title": "COSTO FINAL", 'width':'60px', className: "text-right", "targets": 4}
    ];
    var grid3 = {
            'columns': datos3,
            'columnDefs': cabeceras3,
            'createdRow': function ( row, data, index ) {
                if( ! table3.data().any()){   
                    $('#griddet2').dataTable().fnClearTable();
                }
                else{
                    $(row).attr({ id:data.id_cuentactb, mov:data.nombre, afc:data.afectable});
                }
            },
            dom: 'fBrt',
            paging: false,
            searching: true,
            ordering: true,
            buttons: [
                {
                    extend: 'csvHtml5',
                    charset: 'UTF-8',
                    bom: true,
                    text: 'csv',
                    filename: '<?php echo "edobalgral_".date('Y-m-d');?>',
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
            'scrollY': '50vh',
            'scrollCollapse': true,
            'scrollX': false,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true


    }; 
    $.fn.dataTable.ext.errMode = 'none';
    var table3 = $('#griddet2').DataTable(grid3);
    /////////////////////////////////////////////////////////////////////////////////////////////////

/*    $('#txtbusqueda').on('keyup change', function() {
      //clear global search values
      table1.search('');
      table1.column($(this).data('columnIndex')).search(this.value).draw();
    });

    $(".dataTables_filter input").on('keyup change', function() {
      //clear column search values
      table1.columns().search('');
      //clear input values
      $('#txtbusqueda').val('');
    });*/

    $(document).on('click', '#btnEnviar', function(e) {
            e.preventDefault();
            $('#CargaGif').show();
            event.preventDefault();
            //$('#btnEnviar').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: 'intento.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    $('#griddet').dataTable().fnClearTable();
                    $('#griddet2').dataTable().fnClearTable();
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
    
    $(document).on('click', '#grid tr', function(e) {
        
        e.preventDefault();
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $('#Titulo2').addClass('font-weight-bold');
        $('#slvl').html('Nivel 2');
        var id = $(this).attr("id");
        var mov = $(this).attr("mov");
        $("#TxtClave").val(id);
        $('#Titulo2').html(mov);
        $('#Titulo2').show();
        //alert($(this).parent().attr("id"));
        $('#CargaGif').show();
        $('#lv1').hide();
        event.preventDefault();
        //$('#btnEnviar').attr('disabled', 'disabled');
        var url = '';
        $.ajax({
            type: "POST",
            url: 'con-edobalgral2.php',
            data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
            success: function(data) {
                $('#CargaGif').hide();
                var res = JSON.parse(data);
                $('#lv2').show();
                $('#griddet').dataTable().fnClearTable();
                $('#griddet').dataTable().fnAddData(res);
                $('#griddet').DataTable().draw();
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
    
    $(document).on('click', '#griddet tr', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 3');
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $('#Titulo3').addClass('font-weight-bold');
        var men = $('#Titulo2').html();
        $('#Titulo3').show();
        //var suc = $('#').html();
        //alert(suc);
        var id = $(this).attr("id");
        var mov = $(this).attr("mov");
        $("#TxtClave").val(id);
        $('#Titulo3').html(mov);
        $('#CargaGif').show();
        $('#lv2').hide();
        event.preventDefault();
        //$('#btnEnviar').attr('disabled', 'disabled');
        var url = '';
        $.ajax({
            type: "POST",
            url: 'con-edobalgral3.php',
            data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
            success: function(data) {
                $('#CargaGif').hide();
                var res = JSON.parse(data);
                $('#lv3').show();
                $('#griddet2').dataTable().fnClearTable();
                $('#griddet2').dataTable().fnAddData(res);
                $('#griddet2').DataTable().draw();
                
            },
            error: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
    
    $(document).on('click', '#Titulo1', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 1');
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $(this).addClass('font-weight-bold');
        $('#Titulo2').hide();
        $('#Titulo3').hide();
        $('#Titulo4').hide();
        $('.lvl').hide();
        $('#lv1').show();
    });
    
    $(document).on('click', '#Titulo2', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 2');
        $('#CmbSUCURSALES').val("0");
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $(this).addClass('font-weight-bold');
        $('#Titulo3').hide();
        $('#Titulo4').hide();
        $('.lvl').hide();
        $('#lv2').show();
    });
    
    $(document).on('click', '#Titulo3', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 3');
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $(this).addClass('font-weight-bold');
        $('#Titulo4').hide();
        $('.lvl').hide();
        $('#lv3').show();
    });
    
    $(document).on('click', '#Titulo4', function(e) {
        e.preventDefault();
        $('#slvl').html('Nivel 4');
        $('.breadcrumb li a').removeClass('font-weight-bold');
        $(this).addClass('font-weight-bold');
        $('.lvl').hide();
        $('#lv4').show();
    });

});
</script>
</html>
