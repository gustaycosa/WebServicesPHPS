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

        $query = "Web.RPT_SP_FACTURASPEND @fini = ?, @ffin = ?, @suc = ?";

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
                $data['Telefono'] = utf8_encode($row['Telefono']);
                $data['id_sucursal'] = utf8_encode($row['id_sucursal']);
                $data['fecha'] = utf8_encode($row['fecha']);
                $data['tipodoc'] = utf8_encode($row['tipodoc']);
                $data['folio'] = utf8_encode($row['folio']);
                $data['serie'] = utf8_encode($row['serie']);
                $data['fechavence'] = utf8_encode($row['fechavence']);
                $data['total'] = utf8_encode($row['total']);
                $data['saldodocto'] = utf8_encode($row['saldodocto']);
                $data['c_Moneda'] = utf8_encode($row['c_Moneda']);

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