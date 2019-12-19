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
        $myparams['Empresa'] = "'".$_GET['x1']."'";
        $myparams['Mes'] = "'".$_GET['x2']."'";
        $myparams['Ejercicio'] =  "'".$_GET['x3']."'";

        $procedure_params = array(
        array(&$myparams['Empresa'], SQLSRV_PARAM_IN),
        array(&$myparams['Mes'], SQLSRV_PARAM_IN),
        array(&$myparams['Ejercicio'], SQLSRV_PARAM_IN)
        );
        
        $query = "EXEC dbo.CONTA_SP_EDORESULTADOS @Empresa = '".$_GET['x1']."', @Mes = '".$_GET['x2']."', @Ejercicio = '".$_GET['x3']."'";
//print_r($query);
        $cadena = sqlsrv_query($conn, $query, $procedure_params);

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
                $data['Ene'] = utf8_encode($r['Ene']);
                $data['Feb'] = utf8_encode($r['Feb']);
                $data['Mar'] = utf8_encode($r['Mar']);
                $data['Abr'] = utf8_encode($r['Abr']);
                $data['May'] = utf8_encode($r['May']);
                $data['Jun'] = utf8_encode($r['Jun']);
                $data['Jul'] = utf8_encode($r['Jul']);
                $data['Ago'] = utf8_encode($r['Ago']);
                $data['Sep'] = utf8_encode($r['Sep']);
                $data['Oct'] = utf8_encode($r['Oct']);
                $data['Nov'] = utf8_encode($r['Nov']);
                $data['Dic'] = utf8_encode($r['Dic']);
                $data['TF'] = utf8_encode($r['TF']);
                $arreglo[]= $data;
                }            
            }

        }
        else{
            die( print_r( sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($cadena);
        $json = json_encode( $arreglo );
        echo ($json);
    
?>