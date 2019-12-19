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
//        $x3 = $_GET['x3'];
//        if ($x3 == 0){
//            $x3 = ''
//        }
        $query = "EXEC dbo.RPT_SP_HISTORIAL_CARTERA_2 @Id_Empresa = N'EAGLE', @ffin = N'".$_GET['x2']."', @Id_cliente = N'".$_GET['x3']."', @Id_Sucursal = N'".$_GET['x1']."', @Id_Vendedor = N'".$_GET['x4']."', @Tipo = N'".$_GET['x5']."', @Moneda = N'".$_GET['x6']."'";
        //print_r($query);
        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

            while( $r = sqlsrv_next_result($cadena) ){
                while($row = sqlsrv_fetch_array($cadena) ){ 
                $data = array();

                $data['label'] = $row['label'];
                $data['y'] = $row['y'];
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