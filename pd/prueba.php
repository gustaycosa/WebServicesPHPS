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

/*    $query = "SELECT id_sucursal, Estatus, sucursal FROM SUCURSALES";
    $res =  sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (0 !== sqlsrv_num_rows($res)){
        while ($fila = sqlsrv_fetch_array($res)) {
            echo "Personal: ".utf8_encode($fila['id_sucursal'])." "
                .utf8_encode($fila['Estatus'])." "
                .utf8_encode($fila['sucursal']);
            echo "<br>";
        }
    }*/
        $myparams['sId_empresa'] = 'EAGLE';
        $myparams['sEstatus'] = 'PENDIENTE';
        $myparams['sFechaIni'] = '2019-02-01'; 
        $myparams['sFechaFin'] = '2019-02-20';    
        $myparams['sSucursal'] = 0; 
        $myparams['iSolicita'] = 0; 
        //$myparams['iResponsable'] = $_POST["TxtEjercicio"];
        $myparams['iResponsable'] = '117';
        $myparams['sDepto'] = 'TODOS'; 
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

echo $query."<br>";
    $cadena = sqlsrv_prepare($conn, $query, $procedure_params);
    ///////////////////////////////////////////////////////////////////////////////////
echo $cadena."<br>";
    $arreglo = array();

    if( !$cadena ) {
        die( print_r( sqlsrv_errors(), true));
    }

    if(sqlsrv_execute($cadena)){

        while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

            $data = array();

            echo utf8_encode($row['id_autorizacion'])." ".utf8_encode($row['FechaSolicitud'])." ".utf8_encode($row['Pedido'])." ".utf8_encode($row['CONCEPTO'])." ".utf8_encode($row['NomSolicita'])." ".utf8_encode($row['total'])." ".utf8_encode($row['autorizado']);
            echo "<br>";
        }
    }
    else{
        die( print_r( sqlsrv_errors(), true));
    }
?>
