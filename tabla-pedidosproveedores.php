<?php
    $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
    }else{
        die( print_r( sqlsrv_errors(), true));
    }

        $query = "EXEC dbo.RPT_SP_PEDIDOS_PROVEEDORES @Empresa = N'".$_GET['x1']."',@Ejercicio = N'".$_GET['x2'].$_GET['x3']."'" ;
        //print_r($query);
        $cadena = sqlsrv_query($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){
            while($r = sqlsrv_fetch_array($cadena) ){ 
                $data = array();
                $data['id_sucursal'] = utf8_encode($r['id_sucursal']);
                $data['fecha'] = utf8_encode($r['fecha']);
                $data['pedido'] = utf8_encode($r['pedido']);
                $data['proveedor'] = utf8_encode($r['proveedor']);
                $data['NomProveedor'] = utf8_encode($r['NomProveedor']);
                
                $data['SaldoDeudor'] = utf8_encode($r['SaldoDeudor']);
                $data['observ1'] = utf8_encode($r['observ1']);
                $data['Moneda'] = utf8_encode($r['Moneda']);
                $data['subtotal'] = utf8_encode($r['subtotal']);
                $data['impuestos'] = utf8_encode($r['impuestos']);
                
                $data['Retenciones'] = utf8_encode($r['Retenciones']);
                $data['total'] = utf8_encode($r['total']);
                $data['FechaSolPago'] = utf8_encode($r['FechaSolPago']);
                $data['id_cuenta'] = utf8_encode($r['id_cuenta']);
                $data['Cuenta'] = utf8_encode($r['Cuenta']);
                
                $data['formapago'] = utf8_encode($r['formapago']);
                $data['Pago'] = utf8_encode($r['Pago']);
                $data['beneficiario'] = utf8_encode($r['beneficiario']);
                $data['concepto'] = utf8_encode($r['concepto']);
                $data['total'] = utf8_encode($r['total']);
                
                $data['poliza'] = utf8_encode($r['poliza']);
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