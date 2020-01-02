<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include("../funciones.php"); ?>
<?php echo cabecera(); ?>
<body>
    <div class="panel panel-default">
        <div class="panel-body">
                <div class="progress">
                    <div id="status" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="">
                    </div>
                </div>
            <form id="formulario" method="POST">
                <input type="hidden" value="<?php echo $_GET['id']; ?>" id="txtid" name="txtid">
                <input type="hidden" value="<?php echo $_GET['no']; ?>" id="txtnomb" name="txtnomb">
                <input type="hidden" value="" id="txtpuntos" name="txtpuntos">
            </form>
            <div id="j1" class="jumbotron" style="">
                <h1>Examen ISOCLEAN I</h1>
                <p>1.- Principales mecanismos de desgastes que causan contaminacion por particulas</p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">A.- Abrasion</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">B.- Erosion</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">C.- Fatiga</a></p>
                <p><a class="btn btn-primary btn-lg" resp="1" href="#" role="button">D.- Todas las anteriores</a></p>
            </div>
            <div id="j2" class="jumbotron" style="display:none;">
                <h1>Examen ISOCLEAN I</h1>
                <p>2.- Producto de chevron canditato ISOCLEAN</p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">A.- Rando HD</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">B.- Meropa</a></p>
                <p><a class="btn btn-primary btn-lg" resp="1" href="#" role="button">C.- A y B</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">D.- Ninguna de las anteriores</a></p>
            </div>
            <div id="j3" class="jumbotron" style="display:none;">
                <h1>Examen ISOCLEAN I</h1>
                <p>3.- ¿Como medimos los contaminantes en un fluido?</p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">A.- Mediante un filtro de 3 micras con Beta 2</a></p>
                <p><a class="btn btn-primary btn-lg" resp="1" href="#" role="button">B.- Mediante el codigo de limpieza Norma ISO 4408</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">C.- Mediante la Norma ISO 9000</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">D.- B y C</a></p>
            </div>
            <div id="j4" class="jumbotron" style="display:none;">
                <h1>Examen ISOCLEAN I</h1>
                <p>4.- Para el manejo de los productos ISOCLEAN es necesario utilizar</p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">A.- Filtro desecante</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">B.- Uso de mangueras dedicado por producto</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">C.- Sistema de bombeo dedicado por producto</a></p>
                <p><a class="btn btn-primary btn-lg" resp="1" href="#" role="button">D.- Todas las anteriores</a></p>
            </div>
            <div id="j5" class="jumbotron" style="display:none;">
                <h1>Examen ISOCLEAN I</h1>
                <p>5.- El origen de los productos ISOCLEAN tienen como objetivo</p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">A.- Disminuir la confiabilidad de los equipos, aumentar el impacto de las costosas reclamaciones de garantia, perder la reputacion y posicionamiento de la marca.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="1" href="#" role="button">B.- Incrementar la confiabilidad de los equipos, disminuir el impacto de las costosas relamaciones de garantia, mantener la reputacion y posicionamiento de la marca.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">C.- Ninguna de las anteriores.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">D.- Todas las anteriores.</a></p>
            </div>
            <div id="j6" class="jumbotron" style="display:none;">
                <h1>Examen ISOCLEAN I</h1>
                <p>6.- ¿Que significa que un producto este certificado?</p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">A.- Que se cumpla con el codigo de limpieza Norma ISO 9000 que recomienda el fabricante teniendo mayor confiabilidad en el equipo.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="1" href="#" role="button">B.- Que se cumpla con el codigo de limpieza Norma ISO 4406 que recomienda el fabricante teniendo mayor confiabilidad en el equipo.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">C.- Que se cumpla la utilizacion de un filtro de 3 micras con Beta 2.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">D.- Ninguna de las anteriores.</a></p>
            </div>
            <div id="j7" class="jumbotron" style="display:none;">
                <h1>Examen ISOCLEAN I</h1>
                <p>7.- ¿Si un cliente pregunta, ¿Porque comprar productos ISOCLEAN si el tanque de mi equipo esta sucio?¿Su respuesta seria?</p>
                <p><a class="btn btn-primary btn-lg" resp="1" href="#" role="button">A.- Con el simple echo de colocar un producto mas limpio en el tanque, este gradualmente tomara el codigo de limpieza del fluido ingresado.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">B.- No se preocupe, con un filtro de 3 micras con beta 2 eliminaresmos todos los contaminantes.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">C.- A y B.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">D.- Ninguna de las anteriores.</a></p>
            </div>
            <div id="j8" class="jumbotron" style="display:none;">
                <h1>Examen ISOCLEAN I</h1>
                <p>8.- ¿Cual es el tamaño de la particula que se mide en la norma ISO 406:99?</p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">A.- 38, 70 y 100.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="1" href="#" role="button">B.- 4, 6 y 14 micras.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">C.- 16, 30, 45 micras.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">D.- 2, 4, 6 micras.</a></p>
            </div>
            <div id="j9" class="jumbotron" style="display:none;">
                <h1>Examen ISOCLEAN I</h1>
                <p>9.- ¿Como podemos determinar el nivel de limpieza del lubricante?</p>
                <p><a class="btn btn-primary btn-lg" resp="1" href="#" role="button">A.- Analisis de aceite y con microscopio en sitio.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">B.- Con el color.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">C.- Con el olor y contraluz.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">D.- Contraluz y color.</a></p>
            </div>
            <div id="j10" class="jumbotron" style="display:none;">
                <h1>Examen ISOCLEAN I</h1>
                <p>10.- ¿Que herramienta Chevron nos ayuda a determinar el costo-benefcio del ISOCLEAN?</p>
                <p><a class="btn btn-primary btn-lg" resp="1" href="#" role="button">A.- RBL.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">B.- Proceso de ventas.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">C.- Mpawer.</a></p>
                <p><a class="btn btn-primary btn-lg" resp="0" href="#" role="button">D.- Universidad de lubricantes.</a></p>
            </div>
            
            <div id="jok" class="jumbotron" style="display:none;">
                <h1>Examen aprobado :D</h1>
                <p>Has aprobado el modulo puedes imprimir tu diploma :)</p>
                <a id="aok" href="../diploma.php?id=<?php echo $_GET['id']; ?>&no=<?php echo $_GET['no']; ?>" class="aok btn btn-primary btn-lg">Imprimir Diploma</a>
                <a href="../index.php" class="btn btn-primary btn-lg">Volver a repasar modulo</a>

            </div>
            <div id="jcn" class="jumbotron " style="display:none;">
                <h1>Examen no aprobado :(</h1>
                <p>No has aprobado el modulo, intentalo nuevamente :)</p>
                <a id="acn" href="../index.php" class="btn btn-primary btn-lg">Volver a repasar modulo</a>
            </div>
        </div>
    </div>
</body>  
<?php echo script(); ?>
</html>
<style>
html, body{
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none; 
}
</style>

<script type="text/javascript">
    $(document).ready(function() {
/*        var correctas = 0;
        var bandera = 1;
        var valores = 10;
        var valorini = 100/valores;
        var bar = 100/valores;
        $('#status').prop("style","width:"+valorini+"%;");
        
        $(document).on('click touchstart','.btn',function(){
            var resp = $( this ).attr("resp");
            bar = bar + valorini;
            bandera = bandera + 1;
            $('#status').prop("style","width:"+bar+"%;");
            $('#status').prop("aria-valuenow",valorini);
            $('.jumbotron').hide();
            $('#j'+bandera).show();
            if( resp == 1){
                correctas = correctas + 1;
                //alert(correctas);
            }
            if( bandera == 11 && correctas >= 8){
                $('#status').removeClass('active');
                $('#status').addClass('progress-bar-success');
                alert('Enhorabuena pasaste el examen!');
                getData();
                $('#jok').show();
            }
            else if( bandera == 11 && correctas < 8){
                $('#status').removeClass('active');
                $('#status').addClass('progress-bar-danger');
                alert('Reprobaste el examen, intentalo en otra ocasion.');
                getData();
                $('#jcn').show();
            }
            $('#txtpuntos').val(correctas);
            //$('#spanporc').text(bar.toFixed(2)+"%");
        });*/

/*        function getData(){
            $.ajax({
                type: "POST",
                url: 'contacto.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    $('#btnEnviar').removeAttr('disabled');
                    $("#jok").html(data); // Mostrar la respuestas del script PHP.
                    $("#jok").show();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false; // Evitar ejecutar el submit del formulario.
        }*/
        
        function examentime(){
            if( bandera == valores){
                $('#btnexam').show();
            }
        };
        $(document).bind("contextmenu",function(e){
            return false;
        });
});
$(function(){
    var correctas = 0;
    var bandera = 0;
    var valores = 10;
    var valorini = 100/valores;
    var bar = 0;
    $('#status').prop("style","width:"+0+"%;");

    $(document).on('click touchstart','.btn',function(){
        var resp = $( this ).attr("resp");
        bar = bar + valorini;
        bandera = bandera + 1;
        $('#status').prop("style","width:"+bar+"%;");
        $('#status').prop("aria-valuenow",valorini);
        $('.jumbotron').hide();
        $('#j'+bandera).show();
        if( resp == 1){
            correctas = correctas + 1;
        }
        if( bandera == 11 && correctas >= 8){
            $('#status').removeClass('active');
            $('#status').addClass('progress-bar-success');
            alert('Enhorabuena pasaste el examen!');
            getData();
            $('#jok').show();
        }
        else if( bandera == 11 && correctas < 8){
            $('#status').removeClass('active');
            $('#status').addClass('progress-bar-danger');
            alert('Reprobaste el examen, intentalo en otra ocasion.');
            getData();
            $('#jcn').show();
        }
        $('#txtpuntos').val(correctas);
        //$('#spanporc').text(bar.toFixed(2)+"%");
    });
    
    function getData(){
        $.ajax({
            type: "POST",
            url: 'contacto.php',
            data: $("form").serialize(),
            success: function(data) {
                //$( "#aok" ).attr("href");
                //$('#jok').show();

            },
            error: function(error) {
                //$('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; 
    }

    
/*   $(document).on('click touchstart','a.aok',function(){
        $.ajax({
            type: "POST",
            url: 'contacto.php',
            data: $("form").serialize(),
            success: function(data) {
                //$( "#aok" ).attr("href");
                $('#jok').show();
                window.open("../diploma.php?id=","_blank");
            },
            error: function(error) {
                //$('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false; 
    });*/
    
    $(document).bind("contextmenu",function(e){
        return false;
    });
    function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };

    $(document).bind("keydown", disableF5);

    $(document).on("keydown", disableF5);

    $(document).unbind("keydown", disableF5);

    $(document).off("keydown", disableF5);
});
</script>