<?php
    $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
    }else{
        die( print_r( sqlsrv_errors(), true));
    }

        $query = "EXEC dbo.RPT_SP_GASTOS_CONTA1 @Empresa = N'".$_GET['x1']."',@Mes = N'".$_GET['x2']."',@Ejercicio = N'".$_GET['x3']."'" ;
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
                $data['GastosVenta'] = utf8_encode($r['GastosVenta']);
                $data['GastosAdministracion'] = utf8_encode($r['GastosAdministracion']);
                $data['GastosOperacion'] = utf8_encode($r['GastosOperacion']);
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