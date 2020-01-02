<?php

    $cliente = str_replace(" ", "_", $_POST["TxtCliente"]);
    $Empresa = $_POST["TxtEmpresa"];
    echo file_get_contents('http://192.168.20.130/cmbclientes.php?x1='.$cliente.'&x2='.$Empresa.'');
    //echo 'http://192.168.20.130/cmbcliente.php?x1='.$cliente; 
?>