<?php

    $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
        //echo "Conexión establecida.<br />";
    }else{
        //echo "Conexión no se pudo establecer.<br />";
        die( print_r( sqlsrv_errors(), true));
    }

        $query = "EXEC [dbo].[SP_COMPULSA_ALM_CONTA_A] @EMPRESA = N'".$_GET['x1']."', @MES = N'".$_GET['x2']."', @SUCURSAL = N'".$_GET['x3']."', @EJERCICIO = N'".$_GET['x4']."'";
        //print_r($query);
        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

            while( $r = sqlsrv_next_result($cadena) ){
                while($row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_BOTH)){ 
                $data = array();
//                echo utf8_encode($row['DIVISION'])
//                . utf8_encode($row['DEPTO'])
//                . utf8_encode($row['FAMILIA'])
//                . utf8_encode($row['DESCRIPCION'])
//                . utf8_encode($row['SALDO_INI_ALMACEN'])
//                . utf8_encode($row['TOTAL_ENTRADAS'])
//                . utf8_encode($row['TOTAL_SALIDAS'])
//                . utf8_encode($row['SALDO_INI_CONTA'])
//                . utf8_encode($row['DEBE'])
//                . utf8_encode($row['HABER'])
//                . utf8_encode($row['SALDO_FIN_CONTA'])
//                . utf8_encode($row['DIFERENCIA']);                  
                $data['DIVISION'] = utf8_encode($row['DIVISION']);
                $data['DEPTO'] = utf8_encode($row['DEPTO']);
                $data['FAMILIA'] = utf8_encode($row['FAMILIA']);
                $data['DESCRIPCION'] = utf8_encode($row['DESCRIPCION']);
                $data['SALDO_INI_ALMACEN'] = utf8_encode($row['SALDO_INI_ALMACEN']);
                $data['TOTAL_ENTRADAS'] = $row['TOTAL_ENTRADAS'];
                $data['TOTAL_SALIDAS'] = $row['TOTAL_SALIDAS'];
                $data['SALDO_INI_CONTA'] = utf8_encode($row['SALDO_INI_CONTA']);
                $data['DEBE'] = utf8_encode($row['DEBE']);
                $data['HABER'] = utf8_encode($row['HABER']);
                $data['SALDO_FIN_CONTA'] = utf8_encode($row['SALDO_FIN_CONTA']);
                $data['DIFERENCIA'] = utf8_encode($row['DIFERENCIA']);
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