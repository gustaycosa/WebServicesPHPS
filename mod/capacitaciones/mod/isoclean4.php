<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include("../funciones.php"); ?>
<?php echo cabecera(); ?>
<body>
    <div class="panel panel-default">
       <div class="panel-heading <?php $emp = $_GET["a"]; echo $emp;?>">
            <h2>Confiabilidad Operacional del Equipo</h2>
        </div>
        <div class="panel-body">
            <p>COE = (Disponibilidad)*(Rendimiento)*(Caidad)</p>
            <ul>
                <li><strong>Disponibilidad = (Tt -D)/Tt</strong> (Tt = Tiempo Total de operacion, D = Demoras).</li>
                <li><strong>Rendimiento = Sr/So</strong> (Sr = Salida real, So = Salida Optima, Puede estar referenciando al ciclo de tiempo ideal - que es el tiempo minimo que se espera obtener en condiciones optimas de operacion).</li>
                <li><strong>Calidad: (Ot -W)/Ot</strong> (Ot = Produccion total, W = Desperdicio).</li>
            </ul>
        </div>
    </div>
 </body>  
<?php echo script(); ?>
</html>
