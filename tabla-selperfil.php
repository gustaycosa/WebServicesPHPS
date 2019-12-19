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

        $query = "EXEC web.php_SP_CTRL_PERFIL_SELECT @sId_empresa = N'".$_GET['x1']."',@iId = N'".$_GET['x2']."'" ;
        //print_r($query);
        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){
            while($r = sqlsrv_fetch_array($cadena) ){ 
                $data = array();
                $data['Descripcion'] = utf8_encode($r['Descripcion']);
                $data['Tipo'] = utf8_encode($r['Tipo']);
                $data['Modulo'] = utf8_encode($r['Modulo']);
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