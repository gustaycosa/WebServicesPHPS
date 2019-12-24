<?php
    $empresa = 'EAGLE';
    $mes = $_POST["TxtMes"];    
    $suc = $_POST["CmbSUCURSALES"]; 
    $ejercicio = $_POST["TxtEjercicio"]; 
    //print_r('http://ws.eimportacion.com.mx/tabla-contavsalm.php?x1='.$empresa.'&x2='.$mes.'&x3='.$suc.'&x4='.$ejercicio.'');
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-contavsalm.php?x1='.$empresa.'&x2='.$mes.'&x3='.$suc.'&x4='.$ejercicio.'');

?>