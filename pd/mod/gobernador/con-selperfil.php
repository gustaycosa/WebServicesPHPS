<?php
    $empresa = 'EAGLE'; 
    $user = $_POST["TxtClave"];

    echo file_get_contents('http://192.168.20.130/tabla-selperfil.php?x1='.$empresa.'&x2='.$user.'');
?>