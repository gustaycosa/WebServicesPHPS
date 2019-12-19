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

        $query = "EXEC dbo.RPT_SP_COBRANZADIARIA @fini = N'".$_GET['x2']."', @ffin = N'".$_GET['x3']."', @suc = N'".$_GET['x1']."', @estatus = N'".$_GET['x5']."', @Id_Empresa = N'".$_GET['x6']."', @cliente = N'".$_GET['x4']."'";
        //print_r($query);

        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

            //while( $row = sqlsrv_next_result($cadena) ){
                while($r = sqlsrv_fetch_array($cadena) ){ 
                $data = array();

                $data['fecha'] = utf8_encode($r['fecha']);
                $data['id_cliente'] = utf8_encode($r['id_cliente']);
                $data['Nombre'] = utf8_encode($r['Nombre']);
                $data['tipodoc'] = utf8_encode($r['tipodoc']);
                $data['id_sucursal'] = utf8_encode($r['id_sucursal']);
                $data['numero'] = utf8_encode($r['numero']);
                $data['concepto'] = utf8_encode($r['concepto']);
                $data['total'] = utf8_encode($r['total']);
                $data['c_moneda'] = utf8_encode($r['c_moneda']);
                $data['sestatus'] = utf8_encode($r['sestatus']);
                $data['Descripcion'] = utf8_encode($r['Descripcion']);
                $arreglo[]= $data;
                }
            //}
        }
        else{
            die( print_r( sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($cadena);
        $json = json_encode( $arreglo );
        echo ($json);
?>