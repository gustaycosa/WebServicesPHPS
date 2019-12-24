<?php

    $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
    }else{
        die( print_r( sqlsrv_errors(), true));
    }

    if ($_POST){

        $myparams['Empresa'] = 'EAGLE';
        $myparams['Mes'] = $_POST["TxtMes"]; 
        $myparams['Ejercicio'] = $_POST["TxtEjercicio"];

        $procedure_params = array(
        array(&$myparams['Empresa'], SQLSRV_PARAM_IN),
        array(&$myparams['Mes'], SQLSRV_PARAM_IN),
        array(&$myparams['Ejercicio'], SQLSRV_PARAM_IN)
        );
        
        $query = "EXEC CONTA_SP_EDORESULTAOS @soc = 'ventas', @sac = '0'";

        $cadena = sqlsrv_prepare($conn, $query, $procedure_params);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){

            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();

                $data['ConceptoCtb'] = utf8_encode($row['ConceptoCtb']);
                $data['Mes_Actual'] = utf8_encode($row['Mes_Actual']);
                $data['Mes_Anterior'] = utf8_encode($row['Mes_Anterior']);
                $data['Acumulado_Act'] = utf8_encode($row['Acumulado_Act']);
                $data['Acumulado_Ant'] = utf8_encode($row['Acumulado_Ant']);

                $arreglo[]= $data;
            }
        }
        else{
            die( print_r( sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($cadena);
        $json = json_encode( $arreglo );
        echo ($json);
    }
?>