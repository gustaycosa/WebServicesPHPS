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

    $query = 'http://192.168.20.130/del-usuarios.php?x1='.$iopc.'&x2='.$id.'';
    print_r($query);
    echo file_get_contents($query);
?>