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
        array(&$myparams['Empresa'], SQLSRV_PARAM_IN),
        array(&$myparams['Mes'], SQLSRV_PARAM_IN),
        array(&$myparams['Ejercicio'], SQLSRV_PARAM_IN)
        );
        
        $query = "EXEC PRUEBA_GUS";

    $cadena = sqlsrv_prepare($conn, $query);
    ///////////////////////////////////////////////////////////////////////////////////

    $arreglo = array();

    if( !$cadena ) {
        die( print_r( sqlsrv_errors(), true));
    }

    //echo sqlsrv_execute($cadena).'<br>';
    if(sqlsrv_execute($cadena)){
echo 'entro';
        while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

            echo utf8_encode($row['ConceptoCtb']);
            echo "<br>";
        }
    }
/* if( sqlsrv_execute( $cadena ) === false ) {
          die( print_r( sqlsrv_errors(), true));
    }*/
    else{
        die( print_r( sqlsrv_errors(), true));
        echo 'error';
    }

?>