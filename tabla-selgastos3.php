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

        $query = "EXEC dbo.RPT_SP_GASTOS_CONTA3 @Empresa = N'".$_GET['x1']."',@Mes = N'".$_GET['x2']."',@Ejercicio = N'".$_GET['x3']."',@Cuenta = N'".$_GET['x4']."',@Periodo = N'".$_GET['x5']."',@Sucursal = N'".$_GET['x6']."'" ;
        //print_r($query);
        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){
            while($r = sqlsrv_fetch_array($cadena) ){ 
                $data = array();
                $data['Id_Empresa'] = utf8_encode($r['Id_Empresa']);
                $data['Periodo'] = utf8_encode($r['Periodo']);
                $data['id_cuentactb'] = utf8_encode($r['id_cuentactb']);
                $data['NomCuenta'] = utf8_encode($r['NomCuenta']);
                $data['Sublibro'] = utf8_encode($r['Sublibro']);
                $data['NomSublibro'] = utf8_encode($r['NomSublibro']);
                $data['Saldo'] = utf8_encode($r['Saldo']);
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