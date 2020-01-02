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

    if ($_POST){
        $myparams['sWhere1'] = $_POST["Cmbdeptos"];
        $myparams['sWhere2'] = $_POST["Cmbdivisiones"];

        $procedure_params = array(
        array(&$myparams['sWhere1'], SQLSRV_PARAM_IN),
        array(&$myparams['sWhere2'], SQLSRV_PARAM_IN),
        );

        $query = "EXEC Web.php_SP_ALM_CBO_FAMILIA @sWhere1 = 'AC', @sWhere2 = 'CH'";
    $cadena = sqlsrv_prepare($conn, $query);
    ///////////////////////////////////////////////////////////////////////////////////
        //echo $cadena.'<br>';
    $arreglo = array();

    if( !$cadena ) {
        die( print_r( sqlsrv_errors(), true));
    }
//echo sqlsrv_execute($cadena).'<br>';
    if(sqlsrv_execute($cadena)){
        $i = 0;
            
            $data = array();
            //print_r(sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC));
            //echo $row['CONCEPTO']."<br>";
            $Cmb = "<select id='Cmbfamilia' name='Cmbfamilia' class='col-sm-12 form-control'><option value='0'>TODO ()</option>"; 
            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {
                $i = $i + 1;
                $Cmb = $Cmb."<option class='col-sm-12' value='".utf8_encode($row['C1'])."'>".utf8_encode($row['C2'])."</option>";
            }
            $Cmb = $Cmb."</select>";
            //echo $i;
            echo $Cmb;
        }
        else{
            die( print_r( sqlsrv_errors(), true));
        }
    }
?>