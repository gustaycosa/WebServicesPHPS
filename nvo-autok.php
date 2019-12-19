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
        
        EXEC dbo.SP_AutorizaOrdenCompra @Id_Autorizacion = N'".$_GET['x1']."', @Orden = N'".$_GET['x2']."', @Respuesta = N'".$_GET['x3']."', @sTipo = ".$_GET['x4'].", @iError = @iError OUTPUT, @msg = @msg OUTPUT
        
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