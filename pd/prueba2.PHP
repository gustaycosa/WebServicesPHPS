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
        //$myparams['sId_empresa'] = 'EAGLE';
        $myparams['Empresa'] = 'eagle';
        $myparams['Mes'] = '01'; 
        $myparams['Ejercicio'] = '2019';

        $procedure_params = array(
        array(&$myparams['Empresa']),
        array(&$myparams['Mes']),
        array(&$myparams['Ejercicio'])
        );
echo "arreglo llenao.<br />";
        
        $query = "EXEC CONTA_SP_EDORESULTADOS @Empresa = 'eagle', @Mes = '01', @Ejercicio='2019'";
echo $query.'<br>';
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
print_r(sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC));
            echo $row['ConceptoCtb	'];
            echo "<br>";
        }
        echo $i;
    }
    else{
        die( print_r( sqlsrv_errors(), true));
    }

?>