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

$query = "DECLARE @IError int, 
        @msg nvarchar(250)
        
        EXEC web.php_SP_CTRL_USUARIOS_ABC @iOpc = N'".$_GET['x1']."', @iId = N'".$_GET['x2']."', 
        @sId_Empresa = N'".$_GET['x3']."',@sUsuario = N'".$_GET['x4']."',
        @sContrasena = N'".$_GET['x5']."',@sNombre = N'".$_GET['x6']."',@sTelefono = N'".$_GET['x7']."',
        @iId_Grupo = N'".$_GET['x8']."',@iId_Perfil = N'".$_GET['x9']."',
        @sCorreo = N'".$_GET['x10']."',@sPassCorreo = N'".$_GET['x11']."',
        @iError = @iError OUTPUT, @msg = @msg OUTPUT
        
        SELECT @iError as N'@iError',
        @msg as N'@msg'
        ";
/*
@iOpc Integer,
@iId Integer,
@sId_Empresa NVARCHAR(15),
@sUsuario NVARCHAR(15),
@sContrasena NVARCHAR(15),
@sNombre NVARCHAR(250),
@sTelefono NVARCHAR(15),
@iId_Grupo Integer,
@iId_Perfil Integer,
@sCorreo NVARCHAR(50),
@sPassCorreo NVARCHAR(15),
@iError numeric(1) output,	--1 error 0 no ahi error
@msg NVARCHAR(250) output*/
    
        //print_r($query."<br>");
        $cadena = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (0 !== sqlsrv_num_rows($cadena)){
            while ($fila = sqlsrv_fetch_array($cadena)) {

                $valido = utf8_encode($fila['@iError']);
                $cad = utf8_encode($fila['@msg']);
                //echo $valido;
                echo "<body class="; 
                    if ($valido!=1) {
                        echo "'list-group-item-success'";
                    } else {
                        echo "'list-group-item-danger'";
                           }  
                echo "><div class='container-fluid'><br><br><br><br><br><br>
                        <div class='col-sm-6 col-sm-offset-3 text-center'>
                            <h1>".$cad; 
                
                if ($valido!=1) {
                    echo " :)</h1>";
                } else {
                   echo " :( </h1>";
                }
                             echo "<a class='btn btn-primary btn-lg btn-";
                             if ($valido!=1) {
                                 echo 'success';
                             } else {
                                 echo 'danger';
                             }  
                             echo " href='http://www.eimportacion.com.mx'>Ok entendido</a>
                        </div>
                    </div>
                </body>";

            }
        }
 
?>