<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include("../../funciones.php"); ?>
<head>
<title id="title"></title>
    <meta charset=utf-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="TAYCO SA DE CV" />
    <link rel="stylesheet" type="text/css" href="../../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css"  />
    <link rel="stylesheet" type="text/css" href="../../css/ThemeBlue.css"  />
    <link rel="stylesheet" type="text/css" href="../../css/CargaGif.css"  />
</head>
<body>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 id="cabecera">
                    VENTAS NETAS
                </h6>
            </div>
            <div class="panel-body">
                <form id="formulario" method="POST" class="form-inline">
                    <div class="form-group">
                        <?php echo TxtPeriodo();?>
                    </div>
                    <div class="form-group">
                        <?php echo CmbMes();?>
                    </div>
				    <div class="form-group">
                        <?php echo CmbMoneda();?>
				    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="" placeholder="Ingrese ejercicio">
                    </div>
                    <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button> 
                </form>
                <div class='table-responsive'>
                    <table id='grid' class='table table-bordered table-condensed table-hover display compact' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;"></table>
                </div>
                <div class="respuesta col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>
                <div class="respuesta2 col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>
                <div class="vtasdetalles col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>
                <span id="TotalFac"></span>
                <div class="vtasfacturas col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>             
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

<script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../js/popper.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js" ></script>
<link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="../../js/jeditable.min.js" ></script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="../../js/dataTables.bootstrap.min.js" ></script>
<script type="text/javascript" src="../../js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../../js/buttons.flash.min.js"></script>
<script type="text/javascript" src="../../js/jszip.min.js"></script>
<script type="text/javascript" src="../../js/buttons.print.min.js"></script>
    

    <script type="text/javascript">
        var timer = 0;
        $(function() {  
            
            <?php echo JqueryButtons();?>
            
            document.addEventListener('touchmove', function(e) {
                e.preventDefault();
                var touch = e.touches[0];
                //alert(touch.pageX + " - " + touch.pageY);
            }, false);
/*            $("form").on('submit', function(e) {
                e.preventDefault();
				$('#CargaGif').show();
                $('#btnEnviar').attr('disabled', 'disabled')
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetas.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
						$('#CargaGif').hide();
                        $('#btnEnviar').removeAttr('disabled');
                        $(".respuesta").html(data); // Mostrar la respuestas del script PHP.
                        $(".respuesta").show();
                    },
                    error: function(error) {
						$('#CargaGif').hide();
                        console.log(error);
                        alert('Algo salio mal :S');
                    }
                });
                return false; // Evitar ejecutar el submit del formulario.
            });*/

/*            $('tr.vendedor').dblclick(function() {
                var id = $(this).attr("id");
                alert(id);
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetasdet.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                    },
                    error: function(error) {
                        $('#CargaGif').hide();
                        console.log(error);
                        alert('Algo salio mal :S');
                    }
                });
                return false; // Evitar ejecutar el submit del formulario.
            });*/
            $("form").on('submit', function(e) {
                e.preventDefault();
                $('#CargaGif').show();
                getData1();
                //$('#CargaGif').show();   
            });
            
/*            $('tr.vendedor').click(function() {
                var id = $(this).attr("id");
                $("#TxtClave").val(id);
                //$('#CargaGif').show();// Evitar ejecutar el submit del formulario.
            });*/
        });

        $('select#TxtMes').on('change', function() {
            var id = $('#TxtEjercicio').val();
            var name = $('#TxtMes option:selected').html();
            $("#title").html("VENTAS NETAS - PERIODO " + id + " - " + name);
            $("#cabecera").html("VENTAS NETAS - PERIODO " + name + " - " + id );
        });
        
/*      
        $(document).on('dblclick touchstart','tr.vendedor',function(){
            var id = $(this).attr("id");
            $("#TxtClave").val(id);
            $('#CargaGif').show();
            $.ajax({
                type: "POST",
                url: 'tabla-vtasnetasdet.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    //$('#btnEnviar').removeAttr('disabled');
                    $('#CargaGif').hide();
                    $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                    $(".vtasdetalles").show();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false; // Evitar ejecutar el submit del formulario.	
        });
*/
        $(document).on('click touchstart','td.btn_facturado',function(){
            /*
            var id = $(this).attr("id");
            alert(id);
            $("#TxtClave").val(id);
            */
            
            if(timer == 0){
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                //alert("double tap"); 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $("#myModalLabel").text('FACTURADO '+id);
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetasfac.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        $('#gridfact').DataTable().draw();
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
        
        $(document).on('click touchstart','td.btn_SERVICIOTALLER',function(){
            if(timer == 0) {
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $("#myModalLabel").text('SERVICIO TALLER '+id);
                $.ajax({
                    type: "POST",
                    url: 'tabla-tallmechorasservicio.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        //$('#gridfact').DataTable().draw();
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
        
        $(document).on('click touchstart','td.btn_devoluciones',function(){
            if(timer == 0) {
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $("#myModalLabel").text('DEVOLUCIONES '+id);
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetasdev.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        //$('#gridfact').DataTable().draw();
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
        
         $(document).on('click touchstart','td.btn_descuentos',function(){
            if(timer == 0) {
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $("#myModalLabel").text('DESCUENTOS '+id);
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetasdes.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        //$('#gridfact').DataTable().draw();
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
        
         $(document).on('click touchstart','td.btn_garantreem',function(){
            if(timer == 0) {
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $("#myModalLabel").text('GARANTIA REEMBOLSABLE '+id);
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetasrem.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        //$('#gridfact').DataTable().draw();
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
        
         $(document).on('click touchstart','td.btn_garantianore',function(){
            if(timer == 0) {
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $("#myModalLabel").text('GARANTIA NO REEMBOLSABLE '+id);
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetasnre.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        //$('#gridfact').DataTable().draw();
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

        $(document).on('click touchstart','td.btn_refacturacion',function(){
            if(timer == 0) {
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $("#myModalLabel").text('REFACTURACION '+id);
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetasref.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        //$('#gridfact').DataTable().draw();
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

        $(document).on('click touchstart','td.btn_abonomes',function(){
            if(timer == 0) {
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $("#myModalLabel").text('ABONO FACTURAS MES '+id);
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetasabo.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        //$('#gridfact').DataTable().draw();
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
        
        $(document).on('click touchstart','td.btn_devoproducto',function(){
            if(timer == 0) {
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $("#myModalLabel").text('DEVOLUCION PRODUCTO '+id);
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetasdev.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        //$('#gridfact').DataTable().draw();
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
        
        $(document).on('click touchstart','td.btn_devorefactutacion',function(){
            if(timer == 0) {
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $("#myModalLabel").text('DEVOLUCION REFACTURACION '+id);
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetasref.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        //$('#gridfact').DataTable().draw();
                    },
                    error: function(error) {
                        $('#CargaGif').hide();
                        console.log(error);
                        alert('Algo salio mal :S');
                    }
                });
                return false; // Evitar ejecutar el submit del formulario.	
            }
        });
        
        $(document).on('click touchstart','td.btn_cobrado',function(){
            if(timer == 0) {
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).parent().attr("id");
                $("#TxtClave").val(id);
                $("#myModalLabel").text('COBRADO '+id);
                $('#CargaGif').show();
                $.ajax({
                    type: "POST",
                    url: 'tabla-vtasnetascob.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        //$('#btnEnviar').removeAttr('disabled');
                        $('#CargaGif').hide();
                        $(".vtasdetalles").html(data); // Mostrar la respuestas del script PHP.
                        $(".vtasdetalles").show();
                        //$('#MdlMaqDet').modal('show')
                        //$('#gridfact').DataTable().draw();
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
        
        function getData2(){
                $.ajax({
                    type: "POST",
                    url: 'con-vtasnetasnew.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
						$('#CargaGif').hide();
                        $('#btnEnviar').removeAttr('disabled');
                        $(".respuesta2").html(data); // Mostrar la respuestas del script PHP.
                        $(".respuesta2").show();
                    },
                    error: function(error) {
						$('#CargaGif').hide();
                        console.log(error);
                        alert('Algo salio mal :S');
                    }
                });
                return false; // Evitar ejecutar el submit del formulario.
        }
         function getData1(){
                $.ajax({
                    type: "POST",
                    url: 'con-vtasnetasnew.php',
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
        }
        
$(document).ready(function() {

    datos1 = [
        { "data": 'nombre' },
        { "className": 'text-right btn_facturado', "orderable": false, "data": 'Facturado', "defaultContent": ''},
        { "className": 'text-right btn_descuentos', "orderable": false, "data": 'Descuentos', "defaultContent": ''},
        { "className": 'text-right btn_devoproducto', "orderable": false, "data": 'DevolucionProducto', "defaultContent": ''},
        { "className": 'text-right btn_devorefactutacion', "orderable": false, "data": 'DevolucionRefacturacion',"defaultContent": ''},
        { "className": 'text-right btn_garantianore', "orderable": false, "data": 'GarantiaNoRe', "defaultContent": '' },
        { "className": 'text-right btn_garantreem', "orderable": false, "data": 'GarantiaReem', "defaultContent": '' },
        { "className": 'text-right btn_refacturacion', "orderable": false, "data": 'ReFacturacion', "defaultContent": ''},
        { "className": 'text-right btn_cobrado', "orderable": false, "data": 'TotalCobradoMes', "defaultContent": ''},
        { data: 'VtasNetas', 'className':'text-right' },
    ];
    cabeceras1 = [
        { 'title': 'Nombre',  'width':'200px', className: "text-left", 'targets': 0},
        { 'title': 'Facturado',  'width':'50px', className: "text-right",'targets': 1},
        { 'title': 'Descuentos',  'width':'50px', className: "text-right", 'targets': 2},
        { 'title': 'Dev.Producto',  'width':'50px', className: "text-right", 'targets': 3},
        { 'title': 'Dev.Refacturacion',  'width':'50px', className: "text-right", 'targets': 4},
        { 'title': 'GarantiaNoRe',  'width':'50px', className: "text-right", 'targets': 5},
        { 'title': 'GarantiaReem',  'width':'50px', className: "text-right", 'targets': 6},
        { 'title': 'ReFacturacion',  'width':'50px', className: "text-right", 'targets': 7},
        { 'title': 'Cobrado',  'width':'50px', className: "text-right", 'targets': 8},
        { 'title': 'Vtas netas',  'width':'50px', className: "text-right", 'targets': 9}
    ];
    var grid1 = {
            'columns': datos1,
            'columnDefs': cabeceras1,
            'createdRow': function (row,data,index){
                $(row).attr({ id:data.id_Vendedor,mov:data.Periodo});
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
                    filename: '<?php echo "vtasnetas_".date('Y-m-d');?>',
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
            'fixedHeader': {
                header: true,
                footer: false
            },
            'responsive':true
    }; 
    var table = $('#grid').DataTable(grid1);

    datos2 = [
        { data: "id_autorizacion" },
        { data: "FechaSolicitud" },
        { data: "Pedido" },
        { data: "CONCEPTO" },
        { data: "NomSolicita" },
        { data: "total" },
        { data: "autorizado" },
        {
            "className": 'autok',
            "orderable": false,
            "data":'',
            "defaultContent":'AUTORIZAR'
        },
        {
            "className": 'autcn',
            "orderable": false,
            "data":'',
            "defaultContent":'RECHAZAR'
        },
    ];
    cabeceras2 = [
        { "title": "ID", 'width':'60px', className: "text-left", "targets": 0},
        { "title": "FECHA", 'width':'60px', className: "text-left", "targets": 1},
        { "title": "PEDIDO", 'width':'60px', className: "text-left", "targets": 2},
        { "title": "CONCEPTO", 'width':'150px', className: "text-left", "targets": 3},
        { "title": "SOLICITA", 'width':'60px', className: "text-left", "targets": 4},
        { "title": "TOTAL", 'width':'60px', className: "text-right", "targets": 5},
        { "title": "ESTATUS", 'width':'60px', className: "text-left", "targets": 6},
        { "title": "", 'width':'60px', className: "text-right", "targets": 7},
        { "title": "", 'width':'60px', className: "text-left", "targets": 8}
    ];
    var grid2 = {
            'columns': datos2,
            'columnDefs': cabeceras2,
            'createdRow': function (row,data,index){
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
                    filename: '<?php echo "vtasnetas_".date('Y-m-d');?>',
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
    var table = $('#grid2').DataTable(grid2);
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
//    $('#CargaGif').show();
//    $('#btnEnviar2').click();
});
    </script>

</html>
