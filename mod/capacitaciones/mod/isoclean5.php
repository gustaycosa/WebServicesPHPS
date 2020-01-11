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
                <li><strong>COE menor a 65% INACEPTABLE</strong> Se producen importantes perdidas economicas. Muy baja competitividad.</li>
                <li><strong>COE 65%-75% REGULAR</strong> Aceptable solo si se esta en proceso de mejora. Perdidas economicas. Baja competitividad.</li>
                <li><strong>COE 75%-85% ACEPTABLE</strong> Continuar la mejora para superar al 85% y avanzar hacia la clase mundial. Ligeras perdidas economicas. Competitividad ligeramente baja.</li>
                <li><strong>COE 85%-85% BUENA</strong> Entra en valores de clase mundial. Buena competitividad.</li>
                <li><strong>COE mayor a 95% EXCELENCIA</strong> Valores de clase mundial. Excelente competitividad.</li>
            </ul>
        </div>
    </div>
 </body>  
<?php echo script(); ?>
</html>
