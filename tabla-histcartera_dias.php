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
    
//        $myparams['suc'] = $_GET['x1']; 
//        $myparams['fini'] = "'".$_GET['x2']."'";
//        $procedure_params = array(
//        array(&$myparams['suc'], SQLSRV_PARAM_IN),
//        array(&$myparams['fini'], SQLSRV_PARAM_IN),
//        array(&$myparams['ffin'], SQLSRV_PARAM_IN)
//        );


        $query = "dbo.RPT_SP_HISTORIAL_CARTERA_DIAS @Id_Empresa = N'EAGLE', @ffin = N'".$_GET['x2']."', @Id_cliente =  N'".$_GET['x3']."', @Id_Sucursal = N'".$_GET['x1']."', @Id_Vendedor = N'".$_GET['x4']."', @Tipo = N'".$_GET['x5']."', @Moneda = N'".$_GET['x6']."', @a = ".$_GET['x7'].", @b = ".$_GET['x8']."";
        //print_r($query);
        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();
        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

                while($row = sqlsrv_fetch_array($cadena) ){ 
                
                $data = array();
                $data['Sucursal'] = utf8_encode($row['Sucursal']);
                $data['Id_Cliente'] = utf8_encode($row['Id_Cliente']);
                $data['Cliente'] = utf8_encode($row['Cliente']);
                $data['serie'] = utf8_encode($row['serie']);
                $data['Folio'] = utf8_encode($row['Folio']);
                $data['concepto'] = utf8_encode($row['concepto']);
                $data['FechaFactura'] = utf8_encode($row['FechaFactura']);
                $data['FechaVence'] = utf8_encode($row['FechaVence']);
                $data['dv'] = utf8_encode($row['dv']);
                $data['dc'] = utf8_encode($row['dc']);
                $data['TotalFactura'] = utf8_encode($row['TotalFactura']);
                $data['SaldoFechaEspecificada'] = utf8_encode($row['SaldoFechaEspecificada']);
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