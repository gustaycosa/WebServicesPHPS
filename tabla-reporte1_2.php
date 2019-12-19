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
        $myparams['ffin'] =  "'".$_GET['x3']."'";
        $procedure_params = array(
        array(&$myparams['suc'], SQLSRV_PARAM_IN),
        array(&$myparams['fini'], SQLSRV_PARAM_IN),
        array(&$myparams['ffin'], SQLSRV_PARAM_IN)
        );

        $query = "web.php_SP_COB_PAGOSFACTURA @stipo = N'".$_GET['x1']."', @dfini = N'".$_GET['x2']."', @dffin = N'".$_GET['x3']."', @smoneda = N'".$_GET['x4']."', @sempresa = N'".$_GET['x5']."', @sSucursal = N'".$_GET['x6']."', @sCliente = N'".$_GET['x7']."'";
        //print_r($query);
//        //$query = "select a.fecha,a.id_cliente as id_cliente,a.Nombre,tipodoc,cve_documento,id_sucursal,
//concepto,total,tcambio from CLI_EdoCta  A where tipodoc = 'PAGO'
//and A.id_sucursal = 'DURANGO'
//AND A.fecha BETWEEN '2019-03-01' AND '2019-03-20'
//order by a.fecha,a.id_cliente";

        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

            while( $r = sqlsrv_next_result($cadena) ){
                while($row = sqlsrv_fetch_array($cadena) ){
                    
                $data = array();

                //$data['ORDEN'] = utf8_encode($row['ORDEN']);
                $data['Cvetipodocto'] = utf8_encode($row['Cvetipodocto']);
                $data['TimbreFact'] = utf8_encode($row['TimbreFact']);
                $data['TimbrePago'] = utf8_encode($row['TimbrePago']);
                $data['Sucursal'] = utf8_encode($row['Sucursal']);
                $data['Id_Cliente'] = utf8_encode($row['Id_Cliente']);
                $data['Cliente'] = utf8_encode($row['Cliente']);
                $data['FACTURA'] = utf8_encode($row['FACTURA']);
                $data['FOLIO'] = utf8_encode($row['FOLIO']);
                $data['FECHAFACTURA'] = utf8_encode($row['FECHAFACTURA']);
                $data['FECHAVENCE'] = utf8_encode($row['FECHAVENCE']);
                $data['PAGO'] = utf8_encode($row['PAGO']);
                $data['DV'] = utf8_encode($row['DV']);
                $data['DC'] = utf8_encode($row['DC']);
                $data['FECHAPAGO'] = utf8_encode($row['FECHAPAGO']);
                $data['FECHAAPLICAPAGO'] = utf8_encode($row['FECHAAPLICAPAGO']);
                $data['TOTALFACTURA'] = $row['TOTALFACTURA'];
                $data['TOTALPAGO'] = utf8_encode($row['TOTALPAGO']);
                $data['Abono'] = utf8_encode($row['Abono']);
                $data['SALDOFACTURA'] = utf8_encode($row['SALDOFACTURA']);
                $data['SALDOPAGO'] = utf8_encode($row['SALDOPAGO']);     
                    
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