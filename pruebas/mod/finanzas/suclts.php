<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Suc Lts');?>
<body>
<div class="panel panel-default">
   <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
        <h6 id="cabecera">
            Suc Lts
        </h6>
    </div>
    <style>
        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #fff !important;
            border: 0px !important; 
            border-radius: 0px !important;
        }    
    </style>
    <div class="panel-body" style="padding-top:0px;">
        <form id="formulario" method="POST" class="form-inline row">
            <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="0" > 
<!--            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">De:</span>
                <input type="date" name="Fini" id="Fini" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Rango Fecha Inicial"/>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">A:</span>
                <input type="date" name="Ffin" id="Ffin" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Rango Fecha Inicial"/>
            </div>
            <div class="input-group">
                <?php echo CmbClientes(); ?>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">Tipo:</span>
                <select id="cmbtipo" name="cmbtipo" class="form-control">
                    <option value="PAGO">PAGO</option>
                    <option value="FACT">FACTURA</option>
                </select>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">Sucursal:</span>
                <?php echo CmbCualquieras('ID_SUCURSAL','SUCURSAL',"SUCURSALES"); ?>
            </div>
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <span class="input-group-addon">Moneda:</span>
                <select id="cmbmoneda" name="cmbmoneda" class="form-control">
                    <option value="PESOS">PESOS</option>
                    <option value="DOLARES">DOLARES</option>
                </select>
            </div>-->
            <div class="input-group col-xs-6 col-sm-2" style="float:left;">
                <button type="submit" id="btnEnviar2" class="btn btn-primary btn-sm" onMouseOver=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
            </div>

        </form>
        <div id="chartcolumnas" class="col-sm-6 row" style="height:350px;margin: 0px auto; "></div>
        <div id="chartpie" class="col-sm-6 row" style="height:350px;margin: 0px auto; "></div>
        <div id="chartbar" class="col-sm-6 row" style="height:350px;margin: 0px auto; "></div>
        <div id="chartline" class="col-sm-6 row" style="height:350px;margin: 0px auto; "></div>
<!--        <div class="table-responsive row">
            <table id='grid'  class='table table-striped table-bordered table-condensed table-hover display compact dataTable no-footer' cellspacing='0' style="width:100%;margin:0 auto;clear:both;border-collapse:collapse;table-layout:fixed;word-wrap:break-word;" >
                <tfoot>
                    <tr>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th></th><th></th>
                    </tr>
                </tfoot>
            </table>
        </div>   -->             

        <?php echo CargaGif();?>
    </div>
</div>



</body>

<?php echo Script();?>
<body>

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

<script type="text/javascript">
var timer = 0;
var id = 0;
    
$(function() {        


});

    
$(document).ready(function(){

var dataPoints = [];

var chartCol = new CanvasJS.Chart("chartcolumnas", {
	title: {
		text: "Sucursal - Litros vendidos"              
	},
	data: [              
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "column",
		dataPoints: dataPoints
	}]
});
var chartPie = new CanvasJS.Chart("chartpie", {
	title: {
		text: "Sucursal - Litros vendidos"              
	},
	data: [              
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "pie",
		dataPoints: dataPoints
	}]
});
   
var chartBar = new CanvasJS.Chart("chartbar", {
	title: {
		text: "Sucursal - Litros vendidos"              
	},
	data: [              
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "bar",
		dataPoints: dataPoints
	}]
});
    
var chartLine = new CanvasJS.Chart("chartline", {
	title: {
		text: "Sucursal - Litros vendidos"              
	},
	data: [              
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "line",
		dataPoints: dataPoints
	}]
});
function addDataCol(data) {
    for (var i = 0; i < data.length; i++) {
        //alert( data[i].label);
        dataPoints.push({
            label: data[i].indexLabel,
            y: data[i].y,
            //indexLabel: data[i].indexLabel
        });
    }
    chartCol.render();
    chartPie.render();
    chartBar.render();
    chartLine.render();
}
    
function addDataPie(data) {
    for (var i = 0; i < data.length; i++) {
        //alert( data[i].label);
        dataPoints.push({
            label: data[i].indexLabel,
            y: data[i].y,
            //indexLabel: data[i].indexLabel
        });
    }
    chartPie.render();
}


//$("#chartContainer").CanvasJSChart(options);
    $(document).on('click', '#btnEnviar2', function(e) {
            e.preventDefault();
            $('#CargaGif').show();
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'con-suclitros.php',
                data: $("form").serialize(),
                success: function(data) {
                    $('#CargaGif').hide();
                    var res = JSON.parse(data);
                    var res2 = JSON.parse(data);
                    //alert(data);
                    addDataCol(res);
                    //addDataPie(res2);
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false;
    });
});
</script>
</html>
