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

	    $query = "EXEC dbo.RPT_SP_COBRANZADIARIA_SELECT @fini = N'".$_GET['x2']."', @ffin = N'".$_GET['x3']."', @cliente = N'".$_GET['x4']."', @suc = N'".$_GET['x1']."', @estatus = N'".$_GET['x5']."'";

        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();
        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

            while( $r = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();
                $data['id_sucursal'] = utf8_encode($r['id_sucursal']);
                $data['ENE'] = utf8_encode($r['ENE']);
                $data['FEB'] = utf8_encode($r['FEB']);
                $data['MAR'] = utf8_encode($r['MAR']);
                $data['ABR'] = utf8_encode($r['ABR']);
                $data['MAY'] = utf8_encode($r['MAY']);
                $data['JUN'] = utf8_encode($r['JUN']);
                $data['JUL'] = utf8_encode($r['JUL']);
                $data['AGO'] = utf8_encode($r['AGO']);
                $data['SEP'] = utf8_encode($r['SEP']);
                $data['OCT'] = utf8_encode($r['OCT']);
                $data['NOV'] = utf8_encode($r['NOV']);
                $data['DIC'] = utf8_encode($r['DIC']);
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