<!DOCTYPE html>
<html class="no-js">

<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Relacion pagos - facturas'); ?>
<?php
    $TituloPantalla = 'Pagos fact';  
	//$Arreglo = array("Nombre","Saldo");
	//echo PasaArreglo($Arreglo);
?>

    <body>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 id="cabecera">
                    <?php echo $TituloPantalla; /*Incluir modal nvo*/?>
                </h6>
            </div>
            <div class="panel-body">
                <form id="formulario" method="POST" class="form-inline">
                    <input type="hidden" id="TxtClave" name="TxtClave">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" selected name="radpag" class="radpag" value="pago">
                             
                        </span>
                        <span class="input-group-addon">
                            PAGO
                        </span>
                    </div><!-- /input-group -->
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" name="radpag" class="radpag" value="fact">
                        </span>
                        <span class="input-group-addon">
                            FACTURA
                        </span>
                    </div><!-- /input-group -->
                    <div class="form-group">
                        <?php echo CmbMoneda();?>
                    </div>
                    <div class="form-group">
                        <?php echo TxtDateRango();?>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver="">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
                        <button type="button" id="btnExcel" class="btn btn-success btn-sm" onMouseOver="">
                            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Excel</button>
                        <button type="button" id="btnPDF" class="btn btn-danger btn-sm" onMouseOver="">
                            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> PDF</button>
                        <button type="button" id="btnPrint" class="btn btn-default btn-sm" onMouseOver="">
                            <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
                    </div>
                </form>
                <div class="respuesta"></div>                 
                <div class="form-inline">
                    <label for="inputFechaIni">Filtro:</label>
                    <input type="text" class="form-control" id="txtbusqueda" name="txtbusqueda" data-column-index='0' value="" placeholder="Busqueda rapida">
                </div>
				<?php echo CargaGif();?>
            </div>
        </div>

        <?php echo Script(); ?>
    </body>

    <script type="text/javascript">
        $(function() {        
            
        $( "#btnExcel" ).click(function() {$('.buttons-excel').click();});
        $( "#btnPDF" ).click(function() {$('.buttons-pdf').click();});
        $( "#btnPrint" ).click(function() {$('.buttons-print').click();});
            
        $("form#formulario").on('submit', function(e) {
                e.preventDefault();
				$('#CargaGif').show();
                $('#btnEnviar').attr('disabled', 'disabled')
                $.ajax({
                    type: "POST",
                    url: 'tabla-pagosfact.php',
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
            });
            
        });
        

    </script>

</html>

