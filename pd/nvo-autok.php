<?php 

/*include("../../funciones.php");
try{ 
    
    if ($_POST){
        $iId = $_POST["TxtRow"];
        $sOrden = $_POST["TxtMov"];
        //$sResp = $_POST["Txtidsolicita"];

        
        //$WebService="http://192.168.1.1/WEB_SERVICES/DataLogs.asmx?wsdl";
        //parametros de la llamada
        $parametros = array();
        $parametros['Id'] = $iId;
        $parametros['Orden'] = $sOrden;
        $parametros['Respuesta'] = 'NO';
        //Invocación al web service
        $WS = new SoapClient($WebService, $parametros);
        //recibimos la respuesta dentro de un objeto
        $result = $WS->AutOrden($parametros);

        $Autoriza = $result->AutOrdenResult->string;

        $valido = $Autoriza[1] ;
        $Cadena = $Autoriza[0] ;
    }
    else{

    }
} catch(SoapFault $e){
  var_dump($e);
}
*/

?>

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

        ///////////////////////////////////////////////////////////////////////////////////
        //$myparams['sId_empresa'] = $_POST["TxtEmpresa"];
        $myparams['Id_Autorizacion'] = $_GET['p1'];
        $myparams['Orden'] = $_GET['p2'];
        $myparams['Respuesta'] = 'SI';
        $myparams['sTipo'] = 0;
        $myparams['iError'] = 0;

        //?p1=33&p2=C0105FACT00159&p3=SI
        //eimportacion.com.mx/AutOrden.php?p1=6286&p2=010702000002&p3=SI
        $procedure_params = array(
        array(&$myparams['Id_Autorizacion'], SQLSRV_PARAM_IN),
        array(&$myparams['Orden'], SQLSRV_PARAM_IN),
        array(&$myparams['Respuesta'], SQLSRV_PARAM_IN),
        array(&$myparams['sTipo'], SQLSRV_PARAM_IN),
        array(&$myparams['iError'], SQLSRV_PARAM_IN)
        //array(&$myparams['sTipo'], SQLSRV_PARAM_OUT)
        );

        $query = "EXEC dbo.SP_AutorizaOrdenCompra @Id_Autorizacion = ?, @Orden = ?, @Respuesta = ?, @sTipo = ?";

        $cadena = sqlsrv_prepare($conn, $query, $procedure_params);
        ///////////////////////////////////////////////////////////////////////////////////

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){

            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();

                $data['id'] = utf8_encode($row);

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