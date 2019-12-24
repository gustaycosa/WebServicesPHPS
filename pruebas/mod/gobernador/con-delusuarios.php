<?php
    $iopc = '2';
    $id = $_POST["TxtClave"];
    $emp = "";
    $nomb = "";
    $us = "";
    $suc = "";
    $pass = "";
    $perfil = "";
    $grupo = "";
    $tel = "";
    $correo = "";
    $passc = "";

    $query = 'http://ws.eimportacion.com.mx/del-usuarios.php?x1='.$iopc.'&x2='.$id.'';
    print_r($query);
    echo file_get_contents($query);
?>