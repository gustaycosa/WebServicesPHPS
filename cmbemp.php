<?php
	$sID = 'ID';
	$sNombre = 'NOMBRE';
	$sTabla = 'NOMBRESUSUARIOWEB';

	$myparams['sID']= $sID ;
	$myparams['sNombre']= $sNombre;
	$myparams['sTabla']= $sTabla;

        $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
        $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);

        if( $conn ) {
            //echo "Conexión establecida.<br />";
        }else{
            //echo "Conexión no se pudo establecer.<br />";
            die( print_r( sqlsrv_errors(), true));
        }

        $procedure_params = array(
        array(&$myparams['sID'], SQLSRV_PARAM_IN),
        array(&$myparams['sNombre'], SQLSRV_PARAM_IN),
        array(&$myparams['sTabla'], SQLSRV_PARAM_IN),
        );

        $query = "EXEC Web.php_SP_GRAL_CBO_CUALQUIERA @sID = ?, @sNombre = ?, @sTabla = ?";

        $cadena = sqlsrv_prepare($conn, $query, $procedure_params);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){
            $Cmb = "<select id='Cmb".$sTabla."' name='Cmb".$sTabla."' class='form-control'><option value='0'>TODO (".$sTabla.")</option>"; 
            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {
                $Cmb = $Cmb."<option class='col-sm-12' value='".utf8_encode($row[$sID])."'>".utf8_encode($row[$sNombre])."</option>";
            }
            $Cmb = $Cmb."</select>";
            echo $Cmb;
        }
        else{
            die( print_r( sqlsrv_errors(), true));
        }

?>