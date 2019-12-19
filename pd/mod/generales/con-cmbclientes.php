<?php

    $cliente = str_replace(" ", "_", $_POST["TxtCliente"]);
    $Empresa = $_POST["TxtEmpresa"];
    echo file_get_contents('http://ws.eimportacion.com.mx/cmbclientes.php?x1='.$cliente.'&x2='.$Empresa.'');
    //echo 'http://ws.eimportacion.com.mx/cmbcliente.php?x1='.$cliente; 
?>