<?php
    $empresa = 'EAGLE';
    $mes = $_POST["TxtMes"];    
    $suc = $_POST["CmbSUCURSALES"]; 
    $ejercicio = $_POST["TxtEjercicio"]; 
    //print_r('http://192.168.20.130/tabla-contavsalm.php?x1='.$empresa.'&x2='.$mes.'&x3='.$suc.'&x4='.$ejercicio.'');
    include('http://192.168.20.130/tabla-contavsalm.php?x1='.$empresa.'&x2='.$mes.'&x3='.$suc.'&x4='.$ejercicio.'');

?>