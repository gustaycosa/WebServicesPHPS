<?php
//	$sID = 'ID_SUCURSAL';
//	$sNombre = 'SUCURSAL';
//	$sTabla = 'SUCURSALES';

//	$myparams['sID']= $sID ;
//	$myparams['sNombre']= $sNombre;
//	$myparams['sTabla']= $sTabla;

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
//        array(&$myparams['sID'], SQLSRV_PARAM_IN),
//        array(&$myparams['sNombre'], SQLSRV_PARAM_IN),
//        array(&$myparams['sTabla'], SQLSRV_PARAM_IN),
//        );

        $query = "EXEC Web.php_SP_SELECT_CLIENTES @CveBusqueda = N'".$_GET['x1']."', @emp = N'".$_GET['x2']."'";
        //print_r($_GET['x1']);
        $cadena = sqlsrv_prepare($conn, $query);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }
        $Cmb = '';
        if(sqlsrv_execute($cadena)){
            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {
                $Cmb = $Cmb."<li><a id='".utf8_encode($row['ID_CLIENTE'])."'>".utf8_encode($row['NOMBRE'])."</a></li>";
            }
            $Cmb = $Cmb."<li role='separator' class='divider'></li>";
            $Cmb = $Cmb."<li id='0'><a>TODOS</a></li>";
            echo $Cmb;
        }
        else{
            die( print_r( sqlsrv_errors(), true));
        }

?>