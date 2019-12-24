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
        ///////////////////////////////////////////////////////////////////////////////////
        $myparams['sUser'] = $_POST['usuario'];
        $myparams['sPass'] = $_POST['password'];

        $procedure_params = array(
        array(&$myparams['sUser'], SQLSRV_PARAM_IN),
        array(&$myparams['sPass'], SQLSRV_PARAM_IN)
        );

        $query = "EXEC Web.php_SP_CTRL_LOGIN @sUser = ?, @sPass = ?";

        $cadena = sqlsrv_query($conn, $query, $procedure_params);
        //echo $cadena;
        $Columnas = array("Id_Usuario","nombre","Email","id_empresa","Id_Perfil","Perfil","TipoPerfil","Id_Grupo","Grupo","Id_Vendedor");
        ///////////////////////////////////////////////////////////////////////////////////

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        $valido = 0;
        $tipo = 0;
        $Id_Usuario = 0;
        $perfil = 0;
        $tipoperfil = 0;
        
        if (0 !== sqlsrv_num_rows($cadena)){

            while( $row = sqlsrv_fetch_array($cadena)) {

                $data = array();

//                $_SESSION['NombreUsuario'] = utf8_encode($row['id_autorizacion']);
//                $_SESSION['Email'] = utf8_encode($row['FechaSolicitud']);
//                $_SESSION['Empresa'] = utf8_encode($row['Pedido']);
//                $_SESSION['Autenticado'] = utf8_encode($row['CONCEPTO']);
//                $_SESSION['Id_ventas'] = utf8_encode($row['NomSolicita']);
                $valido = 1;
                $nombre = utf8_encode($row["nombre"]);
                $Id_Usuario = utf8_encode($row["Id_Usuario"]);
                $tipoperfil = utf8_encode($row["TipoPerfil"]);
                $perfil = utf8_encode($row["Perfil"]);
                utf8_encode($row["Email"]);
                
                $arreglo[]= $data;
                include("principal3.php");
            }
        }
        else{
            $valido = 1;
            die( print_r( sqlsrv_errors(), true));
        }

        //include("principal3.php");
    }
    

?>