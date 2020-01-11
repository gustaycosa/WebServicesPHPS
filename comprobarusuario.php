<?php

    
$serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
    
$connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
    
$conn = sqlsrv_connect( $serverName, $connectionInfo);

    
if( $conn ) {
        //echo "Conexión establecida.<br />";
    }
else{
        
//echo "Conexión no se pudo establecer.<br />";
        
die( print_r( sqlsrv_errors(), true));
    }


        
$query = "EXEC Web.php_SP_CTRL_LOGIN @sUser = N'".$_GET['x1']."', @sPass = N'".$_GET['x2']."'";

        
//$cadena = sqlsrv_query($conn, $query, $procedure_params);
$cadena = sqlsrv_prepare($conn, $query);      
//echo $cadena;
        
//$Columnas = array("Id_Usuario","nombre","Email","id_empresa","Id_Perfil","Perfil","TipoPerfil","Id_Grupo","Grupo","Id_Vendedor");
        
///////////////////////////////////////////////////////////////////////////////////


        
$valido = 0;
   
$nombre = 0;
$TipoPerfil = 0;
$Perfil = 0;
$tipo = 0;
$id_empresa = '';
$Id_Usuario = 0;
        
        
        
        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){

            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {

                $data = array();         
                $valido = 1;
                //echo '<script>alert("'. utf8_encode($row["Id_Usuario"]). utf8_encode($row["nombre"]). utf8_encode($row["TipoPerfil"]).'");</script>';
                $nombre = utf8_encode($row["Nombre"]);

                $Id_Usuario = utf8_encode($row["Id_Usuario"]);

                $TipoPerfil = utf8_encode($row["TipoPerfil"]);

                $Perfil = utf8_encode($row["Perfil"]);
                $id_empresa = utf8_encode($row["id_empresa"]);
                //$formas = utf8_encode($row["formas"]);
                
                $arreglo[]= $data;
                //echo 'se encontraron '.$Id_Usuario;
                //print_r("http://ws.eimportacion.com.mx/principal3.php?x1=".$Id_Usuario."&x2=".$nombre."&x3=".$tipoperfil."&x4=".$perfil."");
                //include("http://ws.eimportacion.com.mx/principal3.php?x1=".$Id_Usuario."&x2=".$nombre."&x3=".$tipoperfil."&x4=".$perfil."");
                //print_r("http://ws.eimportacion.com.mx/principal3.php?x1=".$Id_Usuario."&x3=".$tipoperfil."&x4=".$perfil."");
                if($Id_Usuario == 0){
                    echo '<script>alert("'.$nombre.'"); self.location = "http://www.eimportacion.com.mx";</script>';
                }else{
                    //print_r("http://ws.eimportacion.com.mx/principal3.php?x1=".$Id_Usuario."&x3=".$tipoperfil."&x4=".$perfil."");;
                    echo file_get_contents("http://192.168.20.130/principal3.php?x1=".$Id_Usuario."&x3=".$TipoPerfil."&x4=".$Perfil."&x5=".$id_empresa."");  
                }
            }
        }
        
else{
            
$valido = 1;
            
die( print_r( sqlsrv_errors(), true));
        
}

        
//include("principal3.php");
        


?>