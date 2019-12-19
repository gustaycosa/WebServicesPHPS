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

        $query = "EXEC dbo.RPT_SP_COMPULSA_CTA_CTOS_A_C__REFACTURA @Empresa = N'".$_GET['x1']."',@Sucursal = N'".$_GET['x4']."', @Mes = N'".$_GET['x2']."', @Ejercicio = N'".$_GET['x3']."'" ;
        //print_r($query);
        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

            while($r = sqlsrv_fetch_array($cadena) ){ 
                $data = array();
                $data['Sucursal'] = utf8_encode($r['Sucursal']);
                $data['Fecha'] = utf8_encode($r['Fecha']);
                $data['Tipo'] = utf8_encode($r['Tipo']);
                $data['movimiento'] = utf8_encode($r['movimiento']);
                $data['renglon'] = utf8_encode($r['renglon']);
                $data['TipoDocGenero'] = utf8_encode($r['TipoDocGenero']);
                
                $data['MovtoGenero'] = utf8_encode($r['MovtoGenero']);
                $data['articulo'] = utf8_encode($r['articulo']);
                $data['nombre'] = utf8_encode($r['nombre']);
                $data['entrada'] = utf8_encode($r['entrada']);
                $data['salida'] = utf8_encode($r['salida']);
                    
                $data['costoneto'] = utf8_encode($r['costoneto']);
                $data['DebeAlmacen'] = utf8_encode($r['DebeAlmacen']);
                $data['HaberAlmacen'] = utf8_encode($r['HaberAlmacen']);
                $data['Poliza'] = utf8_encode($r['Poliza']);
                $data['FechaPoliza'] = utf8_encode($r['FechaPoliza']);
                
                $data['id_cuentactb'] = utf8_encode($r['id_cuentactb']);
                $data['DebePoliza'] = utf8_encode($r['DebePoliza']);
                $data['HaberPoliza'] = utf8_encode($r['HaberPoliza']);
                $data['DIF_DEBE'] = utf8_encode($r['DIF_DEBE']);
                $data['DIF_HABER'] = utf8_encode($r['DIF_HABER']);
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