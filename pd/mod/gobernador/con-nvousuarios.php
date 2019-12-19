<?php
    $iopc = '1';
    $id = '0';
    $emp = 'EAGLE';
    $nomb = str_replace(" ", "_", $_POST["txtnombre"]);
    $us = $_POST["txtusuario"];
    $suc = $_POST["CmbSUCURSALES"];
    $pass = $_POST["txtpass"];
    $perfil = $_POST["Cmbperfiles"];
    $grupo = $_POST["CmbGrupos"];
    $tel = $_POST["txttel"];
    $correo = $_POST["txtcorreo"];
    $passc = $_POST["txtpasscorreo"];

    $query = 'http://ws.eimportacion.com.mx/nvo-usuarios.php?x1='.$iopc.'&x2='.$id.'&x3='.$emp.'&x4='.$nomb.'&x5='.$us.'&x6='.$pass.'&x7='.$perfil.'&x8='.$grupo.'&x9='.$tel.'&x10='.$correo.'&x11='.$passc.'&x12='.$suc.'';
    print_r($query);
    echo file_get_contents($query);
?>