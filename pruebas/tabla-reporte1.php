<?php
    ini_set('max_execution_time', 60000);  
    ini_set("default_socket_timeout", 60000);  
    ini_set('memory_limit','256M');   
    ini_set('mysql.connect_timeout', 60000);  
    ini_set('user_ini.cache_ttl', 60000);  
    ini_set('display_errors',0);    
    ini_set('log_errors',1);    
    error_reporting(E_ALL);

    $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
        //echo "Conexión establecida.<br />";
    }else{
        //echo "Conexión no se pudo establecer.<br />";
        die( print_r( sqlsrv_errors(), true));
    }

        ///////////////////////////////////////////////////////////////////////////////////
        //$myparams['sId_empresa'] = $_POST["TxtEmpresa"];
//        $myparams['sId_empresa'] = 'EAGLE';
//        $myparams['sFechaIni'] = $_POST["Fini"]; 
//        $myparams['sFechaFin'] = $_POST["Ffin"];    
//        $myparams['sSucursal'] = $_POST["CmbSUCURSALES"]; 
        
//        $fini = $_POST["Fini"]; 
//        $ffin = $_POST["Ffin"];    
//        $suc = $_POST["CmbSUCURSALES"]; 
        
        $procedure_params = array(
        array(&$myparams['fini'], SQLSRV_PARAM_IN),
        array(&$myparams['ffin'], SQLSRV_PARAM_IN),
        array(&$myparams['suc'], SQLSRV_PARAM_IN)
        );

        $query = "Web.RPT_SP_FACTURASABONO @fini = ?, @ffin = ?, @suc = ?";


        $cadena = sqlsrv_prepare($conn, $query, $procedure_params);
        ///////////////////////////////////////////////////////////////////////////////////

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){

            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {
                $data = array();

                $data['id_cliente'] = utf8_encode($row['id_cliente']);
                $data['Nombre'] = utf8_encode($row['Nombre']);
                $data['tipodoc'] = utf8_encode($row['tipodoc']);
                $data['cve_documento'] = utf8_encode($row['cve_documento']);
                $data['fecha'] = utf8_encode($row['fecha']);
                $data['fechavence'] = utf8_encode($row['fechavence']);
                $data['total'] = utf8_encode($row['total']);
                $data['Pendiente'] = utf8_encode($row['Pendiente']);
                $data['cve_aplico'] = utf8_encode($row['cve_aplico']);
                $data['Documento'] = utf8_encode($row['Documento']);
                $data['totalPago'] = utf8_encode($row['totalPago']);
                $data['remanente'] = utf8_encode($row['remanente']);


                $arreglo[]= $data;
            }
        }
        else{
            die( print_r( sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($cadena);
        $json = json_encode( $arreglo );
        echo ($json);
    }
?>