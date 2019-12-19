<?php
    $empresa = 'EAGLE'; 
    $user = 0; 

    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r($query);
    //print_r($myparams);
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-selusuarios.php?x1='.$empresa.'&x2='.$user.'');
?>