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
    $query = "EXEC CONTA_SP_EDORESULTADOS @Empresa = 'eagle', @Mes = '01', @Ejercicio='2019'";
    $res =  sqlsrv_query($conn, $query);
    if (sqlsrv_num_rows($res)){
        while ($fila = sqlsrv_fetch_array($res)) {
            echo "Personal: ".utf8_encode($fila['ConceptoCtb'])." "
                .utf8_encode($fila['Mes_Actual'])." "
                .utf8_encode($fila['Mes_Anterior']);
            echo "<br>";
        }
    }
?>
