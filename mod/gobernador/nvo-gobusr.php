<?php include("../../funciones.php");

try{ 
    
    if ($_POST){
        $Nombre =  $_POST["txtnombre"]; 
        $Usuario =  $_POST["txtusuario"]; 
		$Pass = $_POST["txtpass"]; 
        $Perfil = $_POST["Cmbperfiles"];
        $Grupo = $_POST["Cmbgrupo"];
		$Telefono = $_POST["txttel"]; 
        $Correo = $_POST["txtcorreo"];
        $PassCorreo = $_POST["txtpasscorreo"];
        //parametros de la llamada
        $parametros = array();
        $parametros['sUsuario'] = $Usuario;
        $parametros['sContrasena'] = $Pass;
        $parametros['sNombre'] = $Nombre;
        $parametros['sTelefono'] = $Telefono;
        $parametros['sId_Empresa'] = $Empresa;
        $parametros['iId_Grupo'] = $Grupo;
        $parametros['iId_Perfil'] = $Perfil;
        $parametros['sCorreo'] = $Correo;
        $parametros['sPassCorreo'] = $PassCorreo;

        $WS = new SoapClient($WebService);
        //recibimos la respuesta dentro de un objeto
        $result = $WS->UsuariosInsert($parametros);
        $xml = $result->UsuariosInsertResult->any;
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

?>

  