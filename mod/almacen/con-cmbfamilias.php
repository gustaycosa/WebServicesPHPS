<?php
    $dep = $_POST["Cmbdeptos"]; 
    $div = $_POST["Cmbdivisiones"]; 
    $cadena = 'http://192.168.20.130/cmbfamilias.php?xx='.$_POST["Cmbdivisiones"].'&x1='.$_POST["Cmbdeptos"];
    echo file_get_contents($cadena);
?>