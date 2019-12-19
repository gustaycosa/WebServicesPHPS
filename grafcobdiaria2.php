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
        //print_r($procedure_params);
	    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '2019-03-01', @ffin = '2019-03-20', @suc = 'DURANGO'";

        //$query = "EXEC dbo.RPT_SP_COBRANZADIARIA @fini = ?, @ffin = ?, @suc = ?";
        //$query = "EXEC dbo.CONTA_SP_BALANCE @Empresa = ?, @Mes = ?, @Ejercicio = ?";
	    $query = "EXEC dbo.RPT_SP_COBRANZADIARIA_4 @fini = '".$_GET['x2']."', @ffin = '".$_GET['x3']."', @cliente = '".$_GET['x4']."', @suc = '".$_GET['x1']."', @estatus = '".$_GET['x5']."', @Id_Empresa = N'".$_GET['x6']."'";

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