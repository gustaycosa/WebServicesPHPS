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


        $myparams['Empresa'] = 'EAGLE';
        $myparams['Mes'] = $_POST["TxtMes"]; 
        $myparams['Ejercicio'] = $_POST["TxtEjercicio"];
        $myparams['id_cuentactb'] = $_POST["TxtClave"];

        $procedure_params = array(
        array(&$myparams['Empresa'], SQLSRV_PARAM_IN),
        array(&$myparams['Mes'], SQLSRV_PARAM_IN),
        array(&$myparams['Ejercicio'], SQLSRV_PARAM_IN),
        array(&$myparams['id_cuentactb'], SQLSRV_PARAM_IN)
        );
        
        $query = "EXEC dbo.CONTA_SP_BALANCE_LV3 @Empresa = ?, @Mes = ?, @Ejercicio = ?, @id_cuentactb = ?";

        $cadena = sqlsrv_prepare($conn, $query, $procedure_params);
        ///////////////////////////////////////////////////////////////////////////////////

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){

            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();


                $data['nombre'] = utf8_encode($row['nombre']);
                $data['debe'] = utf8_encode($row['debe']);
                $data['haber'] = utf8_encode($row['haber']);
                $data['saldo'] = utf8_encode($row['saldo']);
                $data['cfinal'] = utf8_encode($row['cfinal']);

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