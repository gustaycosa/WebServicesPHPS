<?php
    ini_set('allow_url_fopen',1);
    $user = $_POST["usuario"]; 
    $pass = $_POST["password"]; 


    //$query ++++++OBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r++++++
    //print_r++++++
    //set_inc++++++pt/alt/php56/usr/share/pear:/opt/alt/php56/usr/share/php');
    echo file_get_contents('http://192.168.20.130/comprobarusuario.php?x1='.$user.'&x2='.$pass.'');

?>