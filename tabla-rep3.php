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
    }else{
        die( print_r( sqlsrv_errors(), true));
    }
        $procedure_params = array(
        array($myparams['suc'], SQLSRV_PARAM_IN),
        array($myparams['fini'], SQLSRV_PARAM_IN),
        array($myparams['ffin'], SQLSRV_PARAM_IN)
        );
    print_r($myparams);
        //$query = "{call CONTA_SP_BALANCE(?,?,?)}";
        $query = "dbo.RPT_SP_COBRANZADIARIA @fini = ?, @ffin = ?, @suc = ?";

        $cadena = sqlsrv_query($conn, $query, $procedure_params);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

            while( $r = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();

                $data['id_cliente'] = utf8_encode($r['id_cliente']);
                $data['Nombre'] = utf8_encode($r['Nombre']);
                $data['tipodoc'] = utf8_encode($r['tipodoc']);
                $data['cve_documento'] = utf8_encode($r['cve_documento']);
                $data['id_sucursal'] = utf8_encode($r['id_sucursal']);
                $data['concepto'] = utf8_encode($r['concepto']);
                $data['total'] = utf8_encode($r['total']);
                $data['tcambio'] = utf8_encode($r['tcambio']);

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