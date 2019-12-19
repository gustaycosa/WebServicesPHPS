﻿<?php
    $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
        //echo "Conexión establecida.<br />";
    }else{
        //echo "Conexión no se pudo establecer.<br />";
        die( print_r( sqlsrv_errors(), true));
    }

        ///////////////////////////////////////////////////////////////////////////////////
        //$myparams['sId_empresa'] = $_POST["TxtEmpresa"];
//        $myparams['sId_empresa'] = 'EAGLE';
//        $myparams['sFechaIni'] = $_POST["Fini"]; 
//        $myparams['sFechaFin'] = $_POST["Ffin"];    
//        $myparams['sSucursal'] = $_POST["CmbSUCURSALES"]; 
        
//        $fini = $_POST["Fini"]; 
//        $ffin = $_POST["Ffin"];    
//        $suc = $_POST["CmbSUCURSALES"]; 
        
        $myparams['suc'] = $_GET['x1']; 
        $myparams['fini'] = "'".$_GET['x2']."'";
        $myparams['ffin'] =  "'".$_GET['x3']."'";
        $procedure_params = array(
        array(&$myparams['suc'], SQLSRV_PARAM_IN),
        array(&$myparams['fini'], SQLSRV_PARAM_IN),
        array(&$myparams['ffin'], SQLSRV_PARAM_IN)
        );

        $query = "dbo.RPT_SP_FACTURASABONO @fini = '".$_GET['x2']."', @ffin = '".$_GET['x3']."', @cliente = '".$_GET['x4']."', @suc = '".$_GET['x1']."'";

//        //$query = "select a.fecha,a.id_cliente as id_cliente,a.Nombre,tipodoc,cve_documento,id_sucursal,
//concepto,total,tcambio from CLI_EdoCta  A where tipodoc = 'PAGO'
//and A.id_sucursal = 'DURANGO'
//AND A.fecha BETWEEN '2019-03-01' AND '2019-03-20'
//order by a.fecha,a.id_cliente";

        $cadena = sqlsrv_prepare($conn, $query, $procedure_params);
        ///////////////////////////////////////////////////////////////////////////////////

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){

            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();
                $data['id_sucursal'] = utf8_encode($row['id_sucursal']);
                $data['id_cliente'] = utf8_encode($row['id_cliente']);
                $data['Nombre'] = utf8_encode($row['Nombre']);
                $data['tipodoc'] = utf8_encode($row['tipodoc']);
                $data['cve_documento'] = utf8_encode($row['cve_documento']);
                $data['fecha'] = utf8_encode($row['fecha']);
                $data['fechavence'] = utf8_encode($row['fechavence']);
                $data['total'] = utf8_encode($row['total']);
                $data['Pendiente'] = utf8_encode($row['Pendiente']);
                $data['cve_aplico'] = utf8_encode($row['cve_aplico']);
                $data['Documento'] = utf8_encode($row['Documento']);
                $data['totalPago'] = utf8_encode($row['totalPago']);
                $data['remanente'] = utf8_encode($row['remanente']);
         
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