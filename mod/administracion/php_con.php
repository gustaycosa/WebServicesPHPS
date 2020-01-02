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

    if ($_POST){
        ///////////////////////////////////////////////////////////////////////////////////
        //$myparams['sId_empresa'] = $_POST["TxtEmpresa"];
        $myparams['sId_empresa'] = 'EAGLE';
        $myparams['sEstatus'] = $_POST["CmbEstatus"];
        $myparams['sFechaIni'] = $_POST["Fini"]; 
        $myparams['sFechaFin'] = $_POST["Ffin"];    
        $myparams['sSucursal'] = $_POST["CmbSUCURSALES"]; 
        $myparams['iSolicita'] = $_POST["CmbNOMBRESUSUARIOWEB"]; 
        //$myparams['iResponsable'] = $_POST["TxtEjercicio"];
        $myparams['iResponsable'] = '117';
        $myparams['sDepto'] = $_POST["CmbDepto"]; 
        $myparams['sTipo'] = '0';

        $procedure_params = array(
        array(&$myparams['sId_empresa'], SQLSRV_PARAM_IN),
        array(&$myparams['sEstatus'], SQLSRV_PARAM_IN),
        array(&$myparams['sFechaIni'], SQLSRV_PARAM_IN),
        array(&$myparams['sFechaFin'], SQLSRV_PARAM_IN), 
        array(&$myparams['sSucursal'], SQLSRV_PARAM_IN),
        array(&$myparams['iSolicita'], SQLSRV_PARAM_IN),
        array(&$myparams['iResponsable'], SQLSRV_PARAM_IN),
        array(&$myparams['sDepto'], SQLSRV_PARAM_IN),
        array(&$myparams['sTipo'], SQLSRV_PARAM_IN)
        );

        $query = "EXEC dbo.AUT_SP_SELECT_AUTORIZACIONES @sId_empresa = ?, @sEstatus = ?, @sFechaIni = ?, @sFechaFin = ?, @sSucursal = ?, @iSolicita = ?, @iResponsable = ?, @sDepto = ?, @sTipo = ?";

        $cadena = sqlsrv_prepare($conn, $query, $procedure_params);
        ///////////////////////////////////////////////////////////////////////////////////

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){

            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();

                $data['id_autorizacion'] = utf8_encode($row['id_autorizacion']);
                $data['FechaSolicitud'] = utf8_encode($row['FechaSolicitud']);
                $data['Pedido'] = utf8_encode($row['Pedido']);
                $data['CONCEPTO'] = utf8_encode($row['CONCEPTO']);
                $data['NomSolicita'] = utf8_encode($row['NomSolicita']);
                $data['total'] = utf8_encode($row['total']);
                $data['autorizado'] = utf8_encode($row['autorizado']);

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