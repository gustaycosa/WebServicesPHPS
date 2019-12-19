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

    $query = "dbo.RPT_SP_FACTURASDIARIA_DET @fini = N'".$_GET['x6']."', @cliente = N'".$_GET['x3']."', @ffin = N'".$_GET['x2']."', @suc = N'".$_GET['x1']."', @tipo = N'".$_GET['x5']."', @user = N'".$_GET['x4']."'";
    //print_r($query);
    $cadena = sqlsrv_query($conn, $query);

    $arreglo = array();

    if( !$cadena ) {
        die( print_r( sqlsrv_errors(), true));
    }

    if (0 !== sqlsrv_num_rows($cadena)){
         while($row = sqlsrv_fetch_array($cadena) ){ 
            $data = array();
            $data['movimiento'] = utf8_encode($row['movimiento']);
            $data['tipocredito'] = utf8_encode($row['tipocredito']);
            $data['sucursal'] = utf8_encode($row['sucursal']);
            $data['fecha'] = utf8_encode($row['fecha']);
            $data['ano'] = utf8_encode($row['ano']);
            $data['mes'] = utf8_encode($row['mes']);
            $data['dia'] = utf8_encode($row['dia']);
            $data['ano_mes'] = utf8_encode($row['ano_mes']);
            $data['id_vendedor'] = utf8_encode($row['id_vendedor']);
            $data['vendedor'] = utf8_encode($row['vendedor']);
            $data['id_cliente'] = utf8_encode($row['id_cliente']);
            $data['cliente'] = utf8_encode($row['cliente']);
            $data['division'] = utf8_encode($row['division']);
            $data['depto'] = utf8_encode($row['depto']);
            $data['familia'] = utf8_encode($row['familia']);
            $data['articulo'] = utf8_encode($row['articulo']);
            $data['descripcion'] = utf8_encode($row['descripcion']);
            $data['unidad_vta'] = utf8_encode($row['unidad_vta']);
            $data['tipodocto'] = utf8_encode($row['tipodocto']);
            $data['folio'] = utf8_encode($row['folio']);
            $data['cantidad'] = utf8_encode($row['cantidad']);
            $data['factor'] = utf8_encode($row['factor']);
            $data['litros'] = utf8_encode($row['litros']);
            $data['precio'] = utf8_encode($row['precio']);
            $data['iva'] = utf8_encode($row['iva']);
            $data['importe_con_iva'] = utf8_encode($row['importe_con_iva']);
            $data['importe_sin_iva'] = utf8_encode($row['importe_sin_iva']);
            $data['estatus'] = utf8_encode($row['estatus']);
            $data['cancelacion'] = utf8_encode($row['cancelacion']);                
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