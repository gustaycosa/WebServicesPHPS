<?php include("../../funciones.php");

try{ 
    
    if ($_POST){
        $parametros = array();
        $parametros['sId_Empresa'] = $Empresa;
        $parametros['iId'] = 0;

        $WS = new SoapClient($WebService);
        //recibimos la respuesta dentro de un objeto
        $result = $WS->UsuariosSelect($parametros);
        $xml = $result->UsuariosSelectResult->any;
        $obj = simplexml_load_string($xml);
        $Datos = $obj->NewDataSet->Table;
    }
    else{

    }

} catch(SoapFault $e){
  var_dump($e);
}
  $arreglo = [];
	for($i=0; $i<count($Datos); $i++){
		$arreglo[$i]=$Datos[$i];
	}
    $json = json_encode($arreglo);
     echo ($json);

?>

