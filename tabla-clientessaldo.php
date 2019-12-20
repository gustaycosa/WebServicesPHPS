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

        $query = "dbo.RPT_SP_CLIENTES_SALDO2 @Empresa = N'".$_GET['x1']."', @Ejercicio = N'".$_GET['x3']."'";
        //print_r($query);
        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();
        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

                while($row = sqlsrv_fetch_array($cadena) ){ 
                
                $data = array();
                $data['Nombre'] = utf8_encode($row['Nombre']);
                $data['ene'] = utf8_encode($row['ene']);
                $data['feb'] = utf8_encode($row['feb']);
                $data['mar'] = utf8_encode($row['mar']);
                $data['abr'] = utf8_encode($row['abr']);
                $data['may'] = utf8_encode($row['may']);
                $data['jun'] = utf8_encode($row['jun']);
                $data['jul'] = utf8_encode($row['jul']);
                $data['ago'] = utf8_encode($row['ago']);
                $data['sep'] = utf8_encode($row['sep']);
                $data['oct'] = utf8_encode($row['oct']);
                $data['nov'] = utf8_encode($row['nov']);
                $data['dic'] = utf8_encode($row['dic']);
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