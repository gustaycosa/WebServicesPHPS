<?php

    $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
    }else{
        die( print_r( sqlsrv_errors(), true));
    }

        $myparams['suc'] = $_GET['x1']; 
        $myparams['fini'] = "'".$_GET['x2']."'";
        $myparams['ffin'] =  "'".$_GET['x3']."'";
        $procedure_params = array(
        array(&$myparams['suc'], SQLSRV_PARAM_IN),
        array(&$myparams['fini'], SQLSRV_PARAM_IN),
        array(&$myparams['ffin'], SQLSRV_PARAM_IN)
        );

	    $query = "dbo.RPT_SP_COBRANZADIARIA_CLIENTES @fini = '".$_GET['x2']."', @ffin = '".$_GET['x3']."', @cliente = '".$_GET['x4']."', @suc = '".$_GET['x1']."', @estatus = '".$_GET['x5']."', @mes = '".$_GET['x6']."', @Id_Empresa = N'".$_GET['x7']."'";

        //print_r($query);
        $cadena = sqlsrv_prepare($conn, $query, $procedure_params);
        ///////////////////////////////////////////////////////////////////////////////////

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){

            while( $r = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();
                $data['id_cliente'] = utf8_encode($r['id_cliente']);
                $data['Nombre'] = utf8_encode($r['Nombre']);
                $data['numero'] = utf8_encode($r['numero']);
                $data['concepto'] = utf8_encode($r['concepto']);
                $data['total'] = utf8_encode($r['total']);
//                $data['fecha'] = utf8_encode($r['fecha']);
//                $data['id_cliente'] = utf8_encode($r['id_cliente']);
//                $data['Nombre'] = utf8_encode($r['Nombre']);
//                $data['tipodoc'] = utf8_encode($r['tipodoc']);
//                $data['numero'] = utf8_encode($r['numero']);
//                $data['id_sucursal'] = utf8_encode($r['id_sucursal']);
//                $data['concepto'] = utf8_encode($r['concepto']);
//                $data['total'] = utf8_encode($r['total']);
//                $data['c_moneda'] = utf8_encode($r['c_moneda']);
//                $data['Descripcion'] = utf8_encode($r['Descripcion']);
//                $data['sestatus'] = utf8_encode($r['sestatus']);
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