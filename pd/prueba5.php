<?php
    $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
        echo "Conexión establecida.<br />";
    }else{
        echo "Conexión no se pudo establecer.<br />";
        die( print_r( sqlsrv_errors(), true));
    }
//    $query = "EXEC dbo.AUT_SP_SELECT_AUTORIZACIONES @sId_empresa = 'EAGLE', @sEstatus = 'PENDIENTE', @sFechaIni = '2019-02-01', @sFechaFin = '2019-02-20', @sSucursal = 0, @iSolicita = 0, @iResponsable = 117, @sDepto = 'TODOS', @sTipo = 0";
    $query = "EXEC CONTA_SP_EDORESULTAOS @soc = 'ventas', @sac = '0'";
    $cadena = sqlsrv_prepare($conn, $query);
    ///////////////////////////////////////////////////////////////////////////////////
echo $cadena.'<br>';
    $arreglo = array();

    if( !$cadena ) {
        die( print_r( sqlsrv_errors(), true));
    }
echo sqlsrv_execute($cadena).'<br>';
    if(sqlsrv_execute($cadena)){
        $i = 0;
        while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {
            $i = $i + 1;
            $data = array();
            //print_r(sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC));
            //echo $row['CONCEPTO']."<br>";
            echo $row['ConceptoCtb']."<br>";
        }
        echo $i;
    }
    else{
        die( print_r( sqlsrv_errors(), true));
    }
?>
