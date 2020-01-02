<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include("funciones.php"); ?>
<head>
<title id="title"></title>
    <meta charset=utf-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="TAYCO SA DE CV" />
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/CargaGif.css"  />
</head>
<body style="height:100%; min-height:400px;">
        <form id="formulario" method="POST">
            <input type="hidden" value="<?php echo $_GET['id']; ?>" id="txtid" name="txtid">
            <input type="hidden" value="<?php echo $_GET['no']; ?>" id="txtnomb" name="txtnomb">
<!--            <input type="hidden" value="" id="txtid">
            <input type="hidden" value="" id="txtid">
            <input type="hidden" value="" id="txtid">-->
        </form>
        <div class="h-80 card">
            <div class="card-header">
                <h1 id="cabecera">Programa ISOCLEAN</h1>
                <strong>Productos certificados ISO 4406</strong>
                <img src="images/logo.png" style="position:absolute;right:30px;top:10px;">
                <img src="images/chevron.png" style="position:absolute;right:150px;top:10px;width:80px;">
            </div>
            <div class="card-body" style="
                height: 650px;
                min-height: 650px;
                max-height: 700px;
            ">
<!--                <div id="statusbar" style="display:block;width:100%;height:10px;background:gray;">
                    <div id="status" style="height:10px;background:green;"></div>
                </div>-->
                <div class="progress">
                    <div id="status" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 3.33333%;">
                        
                    </div>
                </div>
                
                <style>
                    iframe img{
                        width: 100px;
                    }
                </style>
                
                <iframe id="ifrprincipal" src="mod/isoclean1.php" style="width:100%;" class="h-100"></iframe>
                <button id="btnatras" class="btn btn-lg btn-light">ANTERIOR</button>
                <button id="btnsig" class="btn btn-lg btn-light">SIGUIENTE</button>
                <a id="btnexam" style="display:none;" href="mod/exam.php?id=10&amp;no=alberto1" class="btn btn-lg btn-primary">REALIZAR EXAMEN</a>
            </div>
        </div>
    </body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
        var bandera = 1;
        var valores = 30;
        var valorini = 100/valores;
        var bar = 100/valores;
        $('#status').prop("style","width:"+valorini+"%;");
        $('#status').prop("aria-valuenow",valorini);
        
        $(document).on('click touchstart','#btnsig',function(){
            $('#btnatras').show();
            
            bandera = bandera + 1;
            bar = bar + valorini;
            examentime();
            if( bandera > valores){
                //bandera = valores;
                //$('#btnsig').hide();
            }else{
                $('#ifrprincipal').prop("src","mod/isoclean"+bandera+".php");
                $('#status').prop("style","width:"+bar+"%;");
                $('#status').prop("aria-valuenow",valorini);
            }
            //$('#spanporc').text(bar.toFixed(2)+"%");
        });
        
        $(document).on('click touchstart','#btnatras',function(){
            $('#btnsig').show();
            bandera = bandera - 1;
            bar = bar - valorini;
            if( bandera != 1){
                //bandera = 1;
                //$('#btnatras').hide();
                //alert(bandera);
                $('#ifrprincipal').prop("src","mod/isoclean"+bandera+".php");
                $('#status').prop("style","width:"+bar+"%;");
                $('#status').prop("aria-valuenow",valorini);
            }else{
                bandera = bandera - 1
                $('#ifrprincipal').prop("src","mod/isoclean"+bandera+".php");
                $('#status').prop("style","width:"+bar+"%;");
                $('#status').prop("aria-valuenow",valorini);
                //alert(bandera);
            }
        });
        
        function examentime(){
            if( bandera == valores){
                $('#status').removeClass('active');
                $('#status').addClass('progress-bar-success');
                $('#btnexam').show();
            }
        };
/*        $(document).bind("contextmenu",function(e){
            return false;
        });*/
        
        function getData(){
            $.ajax({
                type: "POST",
                url: 'mod/exam.php',
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
    });
    $(function(){
/*        $(document).bind("contextmenu",function(e){
            return false;
        });*/
    });
</script>

</html>
