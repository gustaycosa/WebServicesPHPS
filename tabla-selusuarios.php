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

        $query = "EXEC web.php_SP_CTRL_USUARIOS_SELECT @sId_empresa = N'".$_GET['x1']."',@iId = N'".$_GET['x2']."'" ;
        //print_r($query);
        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){
            while($r = sqlsrv_fetch_array($cadena) ){ 
                $data = array();
                $data['id'] = utf8_encode($r['id']);
                $data['usuario'] = utf8_encode($r['usuario']);
                $data['contraseña'] = utf8_encode($r['contraseña']);
                $data['Tipo'] = utf8_encode($r['Tipo']);
                $data['Prealias'] = utf8_encode($r['Prealias']);
                $data['nombre'] = utf8_encode($r['nombre']);
                $data['Perfil'] = utf8_encode($r['Perfil']);
                $data['Id_Perfil'] = utf8_encode($r['Id_Perfil']);
                $data['Id_Grupo'] = utf8_encode($r['HaberAlmacen']);
                $data['Grupo'] = utf8_encode($r['Grupo']);
                $data['telefono'] = utf8_encode($r['telefono']);
                $data['Estatus'] = utf8_encode($r['Estatus']);
                $data['Correo'] = utf8_encode($r['Correo']);
                $data['PassC'] = utf8_encode($r['PassC']);
                $data['Fum'] = utf8_encode($r['Fum']);
                $data['Id_Usuario_Fum'] = utf8_encode($r['Id_Usuario_Fum']);
                $data['Empleado'] = utf8_encode($r['Empleado']);
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