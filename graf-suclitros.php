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
//        $myparams['ffin'] =  "'".$_GET['x3']."'";
        $procedure_params = array(
        array(&$myparams['suc'], SQLSRV_PARAM_IN),
        array(&$myparams['fini'], SQLSRV_PARAM_IN),
        array(&$myparams['ffin'], SQLSRV_PARAM_IN)
        );

        $query = "dbo.RPT_SP_VENTAS_X_SUCURSAL_LTS_2 @Id_Empresa = N'EAGLE', @Id_Cliente = N'0',@Id_Vendedor = N'0', @Moneda = N'MXN', @FIni = '2019/09/01', @FFin = '2019/09/30'";
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

           while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {
                    
                $data = array();

                $data['y'] = $row['y'];
                $data['label'] = $row['label'];    
                $data['indexLabel'] = utf8_encode($row['indexLabel']);   
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