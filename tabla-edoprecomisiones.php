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

        $query = "EXEC dbo.RPT_SP_PRECOMISIONES @Empresa = '".$_GET['x1']."', @Mes = '".$_GET['x2']."', @Ejercicio = '".$_GET['x3']."'";

        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

                while($r = sqlsrv_fetch_array($cadena) ){ 
                $data = array();
                $data['cve_documento'] = utf8_encode($r['cve_documento']);
                $data['Sucursal'] = utf8_encode($r['Sucursal']);
                $data['Id_Cliente'] = utf8_encode($r['Id_Cliente']);
                $data['Cliente'] = utf8_encode($r['Cliente']);
                $data['id_vendedor'] = utf8_encode($r['id_vendedor']);
                $data['Vendedor'] = utf8_encode($r['Vendedor']);
                $data['Serie'] = utf8_encode($r['Serie']);
                $data['Folio'] = utf8_encode($r['Folio']);
                $data['Subtotal'] = utf8_encode($r['Subtotal']);
                $data['Impuesto'] = utf8_encode($r['Impuesto']);
                $data['Total'] = utf8_encode($r['Total']);
                $data['Costo'] = utf8_encode($r['Costo']);
                $data['Margen'] = utf8_encode($r['Margen']);
                $data['Porc_Margen'] = utf8_encode($r['Porc_Margen']);
                $data['DiasCredito'] = utf8_encode($r['DiasCredito']);
                $data['Fecha'] = utf8_encode($r['Fecha']);
                $data['FechaVence'] = utf8_encode($r['FechaVence']);
                $data['FechaPago'] = utf8_encode($r['FechaPago']);
                $data['ImportePagado'] = utf8_encode($r['ImportePagado']);
                $data['ImportePagadoS_IVA'] = utf8_encode($r['ImportePagadoS_IVA']);
                $data['ImporteNCR'] = utf8_encode($r['ImporteNCR']);
                $data['ImporteNCR_IVA'] = utf8_encode($r['ImporteNCR_IVA']);
                $data['DiasCartera'] = utf8_encode($r['DiasCartera']);
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