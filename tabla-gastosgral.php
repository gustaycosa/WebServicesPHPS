<?php
    $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
    }else{
        die( print_r( sqlsrv_errors(), true));
    }

        $query = "EXEC dbo.RPT_SP_GASTOS_CONTA_GRAL2 @Empresa = N'".$_GET['x1']."',@Fini = N'".$_GET['x2']."',@Ffin = N'".$_GET['x3']."'" ;
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
                $data['Id_Sucursal'] = utf8_encode($r['Id_Sucursal']);
                $data['Periodo'] = utf8_encode($r['Periodo']);
                $data['Depto'] = utf8_encode($r['Depto']);
                $data['id_cuentactb'] = utf8_encode($r['id_cuentactb']);
                $data['Nombre'] = utf8_encode($r['Nombre']);
//                $data['saldo_ant'] = utf8_encode($r['saldo_ant']);
//                $data['debe'] = utf8_encode($r['debe']);
//                $data['haber'] = utf8_encode($r['haber']);
                //$data['SaldoAcreedor'] = utf8_encode($r['SaldoAcreedor']);
                $data['SaldoDeudor'] = utf8_encode($r['SaldoDeudor']);
                //$data['Saldo'] = utf8_encode($r['Saldo']);
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