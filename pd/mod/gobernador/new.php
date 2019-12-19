<!DOCTYPE html>
<html class="no-js">

<?php 
    include("../../funciones.php");  
?>
<head>
<title id="title">X</title>
    <meta charset=utf-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="TAYCO SA DE CV" />
    <link rel="stylesheet" type="text/css" href="../../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css"  />
    <link rel="stylesheet" type="text/css" href="../../css/PushMenu.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/ThemeBlue.css"  />
    <link rel="stylesheet" type="text/css" href="../../css/barratareas.css"  />
    <link rel="stylesheet" type="text/css" href="../../css/CargaGif.css"  />
</head>
<body>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 id="cabecera">
                <?php echo $TituloPantalla; ?>
            </h6>
        </div>
        <div class="panel-body">
            <form id="formulario" method="POST" class="form-inline">
                <input type="hidden" id="TxtClave" name="TxtClave">
                <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
                <button type="button" id="btnNuevo" class="btn btn-primary btn-sm" onMouseOver="" data-toggle="modal" data-target="#mdlnvo">Nuevo</button>
                <button type="button" id="btnEliminar" class="btn btn-primary btn-sm" onMouseOver="">Eliminar</button>
            </form>
            <?php echo CargaGif();?>
        </div>

        <div class='table-responsive'>
            <table id='grid' class='table table-striped table-bordered table-condensed table-hover compact' cellspacing='0' style='width:100%;' >
            </table>
        </div>
        <div class='table-responsive'>
            <table id='griddet' class='table table-striped table-bordered table-condensed table-hover compact' cellspacing='0' style='width:100%;' >
            </table>
        </div>
    </div>
</body>

<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="../../js/jeditable.min.js" ></script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="../../js/dataTables.bootstrap.min.js" ></script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../../js/buttons.flash.min.js"></script>
<script type="text/javascript" src="../../js/jszip.min.js"></script>
<script type="text/javascript" src="../../js/buttons.html5.min.js"></script>
<script type="text/javascript" src="../../js/buttons.print.min.js"></script>
<script type="text/javascript">
var timer = 0;
var id = 0;

$(document).ready(function() {

    var datos1 = [
        { data: 'usuario' },
        { data: 'nombre' },
        { data: 'Perfil' },
        { data: 'Grupo' },
   ];
    var cabeceras1 = [
        { 'title': 'USUARIO', 'width': '70px',  className: "text-left", 'targets': 0},
        { 'title': 'NOMBRE',  'width': '70px',  className: "text-left", 'targets': 1},
        { 'title': 'PERFIL',  'width': '70px',  className: "text-left", 'targets': 2},
        { 'title': 'GRUPO',  'width': '70px',  className: "text-left", 'targets': 3},
    ];
    <?php echo GridNormal('grid1','cabeceras1','datos1',30); ?>
    
    var table = $('#grid').DataTable(grid1);
    //////////////////////////////////////////////////////////////////////////////////////
    //**********************************************************************************//
    //////////////////////////////////////////////////////////////////////////////////////
    var datos2 = [
        { data: 'usuario' },
        { data: 'nombre' },
        { data: 'Perfil' },
   ];
    var cabeceras2 = [
        { 'title': 'USUARIO', 'width': '70px',  className: "text-left", 'targets': 0},
        { 'title': 'NOMBRE',  'width': '70px',  className: "text-left", 'targets': 1},
        { 'title': 'PERFIL',  'width': '70px',  className: "text-left", 'targets': 2},
    ];
    <?php echo GridNormal('grid2','cabeceras2','datos2',30); ?>
    
    var table = $('#griddet').DataTable(grid2);
    //////////////////////////////////////////////////////////////////////////////////////
    //**********************************************************************************//
    //////////////////////////////////////////////////////////////////////////////////////
    
    $(document).on('click', '#btnEnviar', function(event) {
        $('#CargaGif').show();
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: 'tabla-gobnew.php',
            data: $("form").serialize(),
            success: function(data) {
                var res = data;
                $('#CargaGif').hide();
                $('#grid').dataTable().fnClearTable();
                $('#grid').dataTable().fnAddData(res);
                $('#grid').DataTable().draw();
            },or: function(error) {
                $('#CargaGif').hide();
                console.log(error);
                alert('Algo salio mal :S');
            }
        });
        return false;
    });
    
    $(document).on('click', '#exportAll', function() {

        /*
         * For Table 1
         * ===========
         */

        //Index of "csv" button is 3 and in it "export to csv current  page" is at index 1 so it'll be 3-1
        //Index of "excel" button is 4 and in it "export to excel current  page" is at index 1 so it'll be 4-1
        //Index of "pdf" button is 5 and in it "export to pdf current  page" is at index 1 so it'll be 5-1
        //table.buttons(['3-1', '4-1', '5-1']).trigger();

        /*
         * For Table 2
         * ===========
         */

        //Index of "csv" button is 3 and in it "export to csv current  page" is at index 1 so it'll be 3-1
        //Index of "excel" button is 4 and in it "export to excel current  page" is at index 1 so it'll be 4-1
        //Index of "pdf" button is 5 and in it "export to pdf current  page" is at index 1 so it'll be 5-1
        //table2.buttons(['3-1', '4-1', '5-1']).trigger();
    });

});

</script>

</html>
