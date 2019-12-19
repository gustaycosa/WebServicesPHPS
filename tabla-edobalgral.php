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
//        $procedure_params = array(
//        array(&$myparams['Empresa'], SQLSRV_PARAM_IN),
//        array(&$myparams['Mes'], SQLSRV_PARAM_IN),
//        array(&$myparams['Ejercicio'], SQLSRV_PARAM_IN)
//        );
    //print_r($procedure_params);
        //$query = "{call CONTA_SP_BALANCE(?,?,?)}";
        $query = "EXEC dbo.CONTA_SP_BALANCE @Empresa = N'".$_GET['x1']."', @Mes =  N'".$_GET['x2']."', @Ejercicio =  N'".$_GET['x3']."'";

        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

            while( $row = sqlsrv_next_result($cadena) ){
                while($r = sqlsrv_fetch_array($cadena) ){ 
                $data = array();

                $data['Id_ConceptoCtb'] = utf8_encode($r['Id_ConceptoCtb']);
                $data['ConceptoCtb'] = utf8_encode($r['ConceptoCtb']);
                $data['Mes_Actual'] = utf8_encode($r['Mes_Actual']);
                $data['Acumulado_Act'] = utf8_encode($r['Acumulado_Act']);
                $data['TF'] = utf8_encode($r['TF']);
                $data['REF'] = utf8_encode($r['REF']);

                $arreglo[]= $data;
            }}
        }
        else{
            die( print_r( sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($cadena);
        $json = json_encode( $arreglo );
        echo ($json);
    
?>