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
//        $myparams['Id_Autorizacion'] = $_GET['x1'];
//        $myparams['Orden'] = $_GET['x2'];
//        $myparams['Respuesta'] = $_GET['x3'];
//        $myparams['sTipo'] = $_GET['x4'];
////        $myparams['iError'] = $_GET['x5'];
////        $myparams['msg'] = "'".$_GET['x6']."'";
//        //?p1=33&p2=C0105FACT00159&p3=SI
//        $procedure_params = array(
//        array(&$myparams['Id_Autorizacion'], SQLSRV_PARAM_IN),
//        array(&$myparams['Orden'], SQLSRV_PARAM_IN),
//        array(&$myparams['Respuesta'], SQLSRV_PARAM_IN),
//        array(&$myparams['sTipo'], SQLSRV_PARAM_IN),
//        array(&$myparams['iError'], SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT ),
//	    array(&$myparams['msg'], SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_STRING(SQLSRV_ENC_CHAR),(SQLSRV_SQLTYPE_NVARCHAR(2000)))
//        //array(&$myparams['sTipo'], SQLSRV_PARAM_OUT)
//        );
        //print_r($_GET['x1']);
        //$query = "exec dbo.SP_AutorizaOrdenCompra @Id_Autorizacion = ".$_GET['x1'].", @Orden = ".$_GET['x2'].", @Respuesta = ".$_GET['x3'].", @sTipo = ".$_GET['x4'].", @iError = ? OUTPUT, @msg = ? OUTPUT";
        //$query = "exec dbo.SP_AutorizaOrdenCompra @Id_Autorizacion = 6286, @Orden = 010701000002, @Respuesta = si, @sTipo = 0, @iError = ? OUTPUT, @msg = ? OUTPUT";
$query = "DECLARE @IError int, 
        @EmailSolicita nvarchar(50), 
        @msg nvarchar(250)
        
        EXEC dbo.SP_AutorizaCliHistorialAutorizaciones @Id_Autorizacion = N'".$_GET['x1']."', @Mov = N'".$_GET['x2']."', @Respuesta = N'".$_GET['x3']."', @EmailSolicita = @EmailSolicita OUTPUT, @iError = @iError OUTPUT, @msg = @msg OUTPUT
        
        SELECT @iError as N'@iError',
        @msg as N'@msg'
        ";
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