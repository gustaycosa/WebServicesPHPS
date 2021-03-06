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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
    <link rel="stylesheet" type="text/css" href="css/CargaGif.css"  />
</head>
<body style="background: gray;">
        <form id="formulario" method="POST">
            <input type="hidden" value="<?php echo $_GET['id']; ?>" id="txtid" name="txtid">
            <input type="hidden" value="<?php echo $_GET['no']; ?>" id="txtnomb" name="txtnomb">
<!--            <input type="hidden" value="" id="txtid">
            <input type="hidden" value="" id="txtid">
            <input type="hidden" value="" id="txtid">-->
        </form>
        <div class="">
            <div class="panel-body" style="width: 500px; height: 300px; background: #fdfeff; text-align: center; border-left: 20px #00b8ff solid;     font-family: new times roman;">
                <h1>Diploma</h1>
                <h3>Curso ISOCLEAN Modulo 1</h3>
                <h5>Eagle Importacion SA de CV</h5>
                <p>Reconoce a: </p>
                <span style="text-transform:uppercase;"><?php echo $_GET['no']; ?></span>
                <p>por terminar el curso ISOCLEAN modulo I satisfactoriamente.</p>
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
            $('#spanporc').text(bar.toFixed(2)+"%");
        });
        
        $(document).on('click touchstart','#btnatras',function(){
            $('#btnsig').show();
            bandera = bandera - 1;
            bar = bar - 1;
            if( bandera != 1){
                //bandera = 1;
                //$('#btnatras').hide();
                //alert(bandera);
            }else{
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
        $(document).bind("contextmenu",function(e){
            //return false;
        });
        
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
        $(document).bind("contextmenu",function(e){
            //return false;
        });
    });
</script>

</html>
