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

//        $procedure_params = array(
//        array(&$myparams['Id_Empresa'], SQLSRV_PARAM_IN),
//        array(&$myparams['Mes'], SQLSRV_PARAM_IN),
//        array(&$myparams['Ejercicio'], SQLSRV_PARAM_IN),
//        array(&$myparams['Moneda'], SQLSRV_PARAM_IN)
//        );

        $query = "EXEC dbo.VTAS_SP_GeneralNew2 @Id_Empresa = N'".$_GET['x1']."', @Mes = N'".$_GET['x2']."', @Ejercicio = N'".$_GET['x3']."', @Moneda = N'".$_GET['x4']."'";

        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){

            while( $row = sqlsrv_next_result($cadena) ){
                while($r = sqlsrv_fetch_array($cadena) ){ 
                $data = array();

                $data['Periodo'] = utf8_encode($r['Periodo']);
                $data['id_Vendedor'] = utf8_encode($r['id_Vendedor']);
                $data['nombre'] = utf8_encode($r['nombre']);
                $data['Facturado'] = utf8_encode($r['Facturado']);
                $data['Descuentos'] = utf8_encode($r['Descuentos']);
                $data['DevolucionProducto'] = utf8_encode($r['DevolucionProducto']);
                $data['DevolucionRefacturacion'] = utf8_encode($r['DevolucionRefacturacion']);
                $data['GarantiaNoRe'] = utf8_encode($r['GarantiaNoRe']);
                $data['GarantiaReem'] = utf8_encode($r['GarantiaReem']);
                $data['ReFacturacion'] = utf8_encode($r['ReFacturacion']);
                $data['VtasNetas'] = utf8_encode($r['VtasNetas']);
                $data['AbonosFactMes'] = utf8_encode($r['AbonosFactMes']);
                $data['TotalCobradoMes'] = utf8_encode($r['TotalCobradoMes']);

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