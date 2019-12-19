<?php

    $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
        //echo "Conexión establecida.<br />";
    }else{
        //echo "Conexión no se pudo establecer.<br />";
        die( print_r( sqlsrv_errors(), true));
    }
 
//        $myparams['sDepto'] = $_POST["Cmbdeptos"];    
//        $myparams['sFamilia'] = $_POST["Cmbfamilia"]; 
//        $myparams['sText'] = $_POST["Txtfiltro"]; 
//
//        $procedure_params = array(
//        array(&$myparams['sId_Empresa'], SQLSRV_PARAM_IN),
//        array(&$myparams['sDivision'], SQLSRV_PARAM_IN),
//        array(&$myparams['sDepto'], SQLSRV_PARAM_IN),
//        array(&$myparams['sFamilia'], SQLSRV_PARAM_IN),
//        array(&$myparams['sText'], SQLSRV_PARAM_IN)
//        );
        $query = "EXEC Web.php_SP_ALM_EXISTENCIAS @sId_Empresa = N'".$_GET['x1']."', @sDivision = N'".$_GET['x2']."', @sDepto = N'".$_GET['x3']."', @sFamilia = N'".$_GET['x4']."', @sText = N'".$_GET['x5']."'";

        $cadena = sqlsrv_prepare($conn, $query);
        ///////////////////////////////////////////////////////////////////////////////////

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){

            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();

                $data['ID_SUCURSAL'] = utf8_encode($row['ID_SUCURSAL']);
                $data['ARANCEL'] = utf8_encode($row['ARANCEL']);
                $data['NOMBRE'] = utf8_encode($row['NOMBRE']);
                $data['CODIGO'] = utf8_encode($row['CODIGO']);
                $data['DIVISION'] = utf8_encode($row['DIVISION']);
                $data['DEPTO'] = utf8_encode($row['DEPTO']);
                $data['FAMILIA'] = utf8_encode($row['FAMILIA']);
                $data['EXISTENCIA'] = utf8_encode($row['EXISTENCIA']);
                $data['disponible'] = utf8_encode($row['disponible']);
                $data['costoultimo'] = utf8_encode($row['costoultimo']);
                $data['CostoProm'] = utf8_encode($row['CostoProm']);
                $data['PRECIOVENTA'] = utf8_encode($row['PRECIOVENTA']);
                
                $arreglo[]= $data;
            }
        }
        else{
            die( print_r( sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($cadena);
        $json = json_encode( $arreglo );
        echo ($json);
    
?>