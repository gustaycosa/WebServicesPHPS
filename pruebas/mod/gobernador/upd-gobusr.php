<?php include("../../funciones.php");

try{ 
    
    if ($_POST){
        $Id =  $_POST["TxtId"]; 
        $Nombre =  $_POST["txtnombre"]; 
        $Usuario =  $_POST["txtusuario"]; 
		$Password = $_POST["txtpass"]; 
        $Perfil = $_POST["Cmbperfiles"];
        $Grupo = $_POST["Cmbgrupo"];
		$Telefono = $_POST["txttel"]; 
        $Correo = $_POST["txtcorreo"];
        $PassCorreo = $_POST["txtpasscorreo"];
        //parametros de la llamada
        $parametros = array();
        $parametros['iId'] = $Id;
        $parametros['sUsuario'] = $Usuario;
        $parametros['sContrasena'] = $Password;
        $parametros['sNombre'] = $Nombre;
        $parametros['sTelefono'] = $Telefono;
        $parametros['sId_Empresa'] = $Empresa;
        $parametros['iId_Grupo'] = $Grupo;
        $parametros['iId_Perfil'] = $Perfil;
        $parametros['sCorreo'] = $Correo;
        $parametros['sPassCorreo'] = $PassCorreo;

        $WS = new SoapClient($WebService);
        //recibimos la respuesta dentro de un objeto
        $result = $WS->UsuariosUpdate($parametros);
        $xml = $result->UsuariosUpdateResult->any;
        $obj = simplexml_load_string($xml);
        $Datos = $obj->NewDataSet->Table;
    }
    else{

    }

} catch(SoapFault $e){
  var_dump($e);
}

?>

  