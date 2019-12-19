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
        $procedure_params = array(
        array(&$myparams['suc'], SQLSRV_PARAM_IN),
        array(&$myparams['fini'], SQLSRV_PARAM_IN),
        array(&$myparams['ffin'], SQLSRV_PARAM_IN)
        );

        $query = "dbo.RPT_SP_FACTURASPEND @fini = '".$_GET['x2']."', @cliente = '".$_GET['x3']."', @suc = '".$_GET['x1']."', @Id_Empresa = '".$_GET['x4']."'";

        $cadena = sqlsrv_prepare($conn, $query, $procedure_params);
        ///////////////////////////////////////////////////////////////////////////////////

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){

            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();
                //$data['id_cliente'] = utf8_encode($row['id_cliente']);
                $data['Nombre'] = utf8_encode($row['Nombre']);
                $data['saldoafecha'] = utf8_encode($row['saldoafecha']);
                $data['id_sucursal'] = utf8_encode($row['id_sucursal']);
                $data['fecha'] = utf8_encode($row['fecha']);
                $data['tipodoc'] = utf8_encode($row['tipodoc']);
                $data['numero'] = utf8_encode($row['numero']);
                $data['serie'] = utf8_encode($row['serie']);
                $data['fechavence'] = utf8_encode($row['fechavence']);
                $data['total'] = utf8_encode($row['total']);
                $data['saldodocto'] = utf8_encode($row['saldodocto']);
                $data['c_Moneda'] = utf8_encode($row['c_Moneda']);
         
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