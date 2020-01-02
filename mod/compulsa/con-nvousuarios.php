<?php
    $iopc = '1';
    $id = '0';
    $emp = 'EAGLE';
    $nomb = $_POST["txtnombre"];
    $us = $_POST["txtusuario"];
    $pass = $_POST["txtpass"];
    $perfil = $_POST["Cmbperfiles"];
    $grupo = $_POST["CmbGrupos"];
    $tel = $_POST["txttel"];
    $correo = $_POST["txtcorreo"];
    $passc = $_POST["txtpasscorreo"];

    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r($query);
    //print_r($myparams);
    echo file_get_contents('http://192.168.20.130/tabla-nvousuarios.php?x1='.$iopc.'&x2='.$id.'&x3='.$emp.'&x4='.$nomb.'&x5='.$us.'&x6='.$pass.'&x7='.$perfil.'&x8='.$grupo.'&x9='.$tel.'&x10='.$correo.'&x11='.$passc.'');
?>