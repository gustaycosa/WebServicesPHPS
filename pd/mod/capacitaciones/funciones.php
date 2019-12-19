<?php
    $WebService = 'http://dwh.taycosa.mx/WEB_SERVICES/DataLogs.asmx?wsdl';
    //$WebService = '192.168.1.1/WEB_SERVICES/DataLogs.asmx?wsdl';
    $Empresa = 'TAYCOSA';

    function CmbMes(){
/*
        $nummes = date('m');
        $nombremes = ['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JULIO','JUNIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
*/
        echo '<label for="inputFechaIni">Mes:</label>';
        echo '<select id="TxtMes" name="TxtMes" class="form-control">';
        echo '<option value="01">Enero</option>';
        echo '<option value="02">Febrero</option>';
        echo '<option value="03">Marzo</option>';
        echo '<option value="04">Abril</option>';
        echo '<option value="05">Mayo</option>';
        echo '<option value="06">Junio</option>';
        echo '<option value="07">Julio</option>';
        echo '<option value="08">Agosto</option>';
        echo '<option value="09">Septiembre</option>';
        echo '<option value="10">Octubre</option>';
        echo '<option value="11">Noviembre</option>';
        echo '<option value="12">Diciembre</option>';
        echo '</select>';
    }

    function TxtPeriodo(){
        echo '<label for="inputFechaIni">Ejercicio:</label>';
        echo '<input type="text" class="form-control" id="TxtEjercicio" name="TxtEjercicio" ';
        echo 'value="'. date("Y").'" placeholder="Ingrese ejercicio">';
    }

    function CmbMoneda(){
        echo '<label for="inputFechaIni">Moneda:</label>';
        echo '<select id="CmbMoneda" name="CmbMoneda" class="form-control">';
          echo '<option>PESOS</option>';
          echo '<option>DOLARES</option>';
        echo '</select>';
    }

    function TxtDateRango(){
        echo '<label for="inputFechaIni">De:</label>';
        echo '<input type="date" name="Fini" id="Fini" value="'.date("Y"."-"."m"."-"."01").'" class="form-control" placeholder="Rango Fecha Inicial"/>';
        echo '<label for="inputFechaFin">A:</label>';
        echo '<input type="date" name="Ffin" id="Ffin" value="'.date("Y-m-d").'" class="form-control" placeholder="Rango Fecha Final" >';
    }

    function CmbClientes(){
        echo '<div class="input-group-btn">';
        echo '<button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        echo '<span class="glyphicon glyphicon-search"></span></button>';
        echo '<ul id="CmbClientes" class="dropdown-menu">';
        echo '</ul>';
        echo '</div>';
        echo '<input type="text" class="form-control" id="TxtCliente" name="TxtCliente" autocomplete="off" placeholder="Buscar cliente o ID cliente">';
        echo '<div class="input-group-btn"> ';
        echo '<button type="button" id="btninfocliente" class="btn btn-default btn-sm" style="width: 200px; position: relative;white-space: nowrap; ';
        echo 'overflow: hidden; text-overflow: ellipsis;">Info cliente</button> ';
        echo '</div> ';
    }

    function JqueryCmbClientes(){
        echo 'var typingTimer;
        var doneTypingInterval = 2200;
        $("#TxtCliente").keyup(function(){
            clearTimeout(typingTimer);
            if ($("#TxtCliente").val()) {
               typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });
        
        function doneTyping (){
            var value = $("#TxtCliente").val();
            $("#TxtClave").text( value );
            $("#CargaGif").show();
            $.ajax({
                type: "POST",
                url: "../generales/CmbClientes.php",
                data: $("#TxtCliente").serialize(), 
                success: function(data) {
                    $("#CargaGif").hide();
                    $(".dropdown-menu").html(data); 
                    $(".dropdown-menu").show();
                },
                error: function(error) {
                    $("#CargaGif").hide();
                    console.log(error);
                    alert("Algo salio mal :S");
                }
            });
            return false;
        }
        
        $(document).on("click touchstart",".dropdown-menu li a",function(){
            var infocliente = $( this ).text();
            var idcliente = $( this ).attr("id");
            $("#btninfocliente").text( idcliente + "-" + infocliente );
            $("#TxtClave").val( idcliente );
            $(".dropdown-menu").hide();
        });
        ';
    }

    function BusquedaGrid($iColumna, $sTexto){
        echo '<input type="text" class="form-control" id="txtbusqueda" name="txtbusqueda" data-column-index="'.$iColumna.'" value="" placeholder="Busqueda por '.$sTexto.'">';
    }

    function HtmlButtons(){
        echo '<button type="button" id="btnExcel" class="btn btn-success btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>Descargar Excel</button>';                   
        echo '<button type="button" id="btnPrint" class="btn btn-default btn-sm" onMouseOver=""><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>';
        /*echo '<button type="button" id="btnPDF" class="btn btn-danger btn-sm" onMouseOver=""><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>Descargar PDF</button>';*/
    }

    function JqueryButtons(){
        echo '$( "#btnExcel" ).click(function() {$(".buttons-excel").click();});';
    }

    function CmbGenerico($sWhere1,$sWhere2){
        try{ 
            $WebService="http://dwh.taycosa.mx/WEB_SERVICES/DataLogs.asmx?wsdl";
            //parametros de la llamada

            $parametros = array();
            $parametros['sWhere1'] = $sWhere1;
            $parametros['sWhere2'] = $sWhere2;
            //Invocación al web service
            $WS = new SoapClient($WebService,$parametros);
            //recibimos la respuesta dentro de un objeto
            $result = $WS->CBO_ALM_FAMILIAS($parametros);
            $xml = $result->CBO_ALM_FAMILIASResult->any;
            $obj = simplexml_load_string($xml);
            $Datos = $obj->NewDataSet->Table;

        } catch(SoapFault $e){
          var_dump($e);
        }
        $Cmb = "<select id='Cmbfamilia' name='Cmbfamilia' class='col-sm-12 form-control'><option value='0'>TODO ()</option>"; 
         for($i=0; $i<count($Datos); $i++){
            $Cmb = $Cmb."<option value='".$Datos[$i]->C1."'>".$Datos[$i]->C2."</option>";
        }
        $Cmb = $Cmb."</select>";

        echo $Cmb;
    }

    function CmbGenerico2($sWhere1,$sWhere2){
        try{ 
            $WebService="http://dwh.taycosa.mx/WEB_SERVICES/DataLogs.asmx?wsdl";
            //parametros de la llamada

            $parametros = array();
            $parametros['sWhere1'] = $sWhere1;
            $parametros['sWhere2'] = $sWhere2;
            //Invocación al web service
            $WS = new SoapClient($WebService,$parametros);
            //recibimos la respuesta dentro de un objeto
            $result = $WS->CBO_ALM_MODELO($parametros);
            $xml = $result->CBO_ALM_MODELOResult->any;
            $obj = simplexml_load_string($xml);
            $Datos = $obj->NewDataSet->Table;

        } catch(SoapFault $e){
          var_dump($e);
        }
        $Cmb = "<select id='CmbModelo name='CmbModelo' class='col-sm-12 form-control'><option value='0'>TODO ()</option>"; 
         for($i=0; $i<count($Datos); $i++){
            $Cmb = $Cmb."<option value='".$Datos[$i]->C1."'>".$Datos[$i]->C2."</option>";
        }
        $Cmb = $Cmb."</select>";
        //return $Cmb;
        echo $Cmb;
    }

    function connbd(){
        $server = 'dwh.eimportacion.com.mx';
        $port = '65069';
        $bd = 'BD_Eagle';
        $user = 'snet';
        $psw = 'QAZwsxedc1010';
        $str = '$serverName = "'.$server.'\\MSSQLSERVER, '.$port.'"; 
        $connectionInfo = array( "Database"=>"'.$bd.'", "UID"=>"'.$user.'", "PWD"=>"'.$psw.'");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn ) {
            //echo "Conexión establecida.<br />";
        }else{
            //echo "Conexión no se pudo establecer.<br />";
            die( print_r( sqlsrv_errors(), true));
        }';
        echo $str;
    }

    function CmbCualquieras($sID,$sNombre,$sTabla){
        $serverName = "dwh.eimportacion.com.mx\\MSSQLSERVER, 65069"; 
        $connectionInfo = array( "Database"=>"BD_Eagle", "UID"=>"snet", "PWD"=>"QAZwsxedc1010");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);

        if( $conn ) {
            //echo "Conexión establecida.<br />";
        }else{
            //echo "Conexión no se pudo establecer.<br />";
            die( print_r( sqlsrv_errors(), true));
        }

        $myparams['sID'] = $sID;
        $myparams['sNombre'] = $sNombre;
        $myparams['sTabla'] = $sTabla;

        $procedure_params = array(
        array(&$myparams['sID'], SQLSRV_PARAM_IN),
        array(&$myparams['sNombre'], SQLSRV_PARAM_IN),
        array(&$myparams['sTabla'], SQLSRV_PARAM_IN),
        );

        $query = "EXEC Web.php_SP_GRAL_CBO_CUALQUIERA @sID = ?, @sNombre = ?, @sTabla = ?";

        $cadena = sqlsrv_prepare($conn, $query, $procedure_params);

        $arreglo = array();

        if( !$cadena ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($cadena)){
            $Cmb = "<select id='Cmb".$sTabla."' name='Cmb".$sTabla."' class='form-control'><option value='0'>TODO (".$sTabla.")</option>"; 
            while( $row = sqlsrv_fetch_array($cadena, SQLSRV_FETCH_ASSOC) ) {
                $Cmb = $Cmb."<option class='col-sm-12' value='".utf8_encode($row[$sID])."'>".utf8_encode($row[$sNombre])."</option>";
            }
            $Cmb = $Cmb."</select>";
            return $Cmb;
        }
        else{
            die( print_r( sqlsrv_errors(), true));
        }
    }

    function CmbCualquieras2($sID,$sNombre,$sTabla){
        try{ 
            $WebService="http://dwh.taycosa.mx/WEB_SERVICES/DataLogs.asmx?wsdl";
            //parametros de la llamada
            $parametros = array();
            $parametros['sID'] = $sID;
            $parametros['sNombre'] = $sNombre;
            $parametros['sTabla'] = $sTabla;
            //Invocación al web service
            $WS = new SoapClient($WebService,$parametros);
            //recibimos la respuesta dentro de un objeto
            $result = $WS->CmbCualquiera($parametros);
            $xml = $result->CmbCualquieraResult->any;
            $obj = simplexml_load_string($xml);
            $Datos = $obj->NewDataSet->Table;
        } catch(SoapFault $e){
          var_dump($e);
        }
        $Cmb = "<select id='Cmb".$sTabla."2' name='Cmb".$sTabla."2' class='form-control'><option value='0'>TODO (".$sTabla.")</option>"; 
         for($i=0; $i<count($Datos); $i++){
            $Cmb = $Cmb."<option class='col-sm-12' value='".$Datos[$i]->$sID."'>".$Datos[$i]->$sNombre."</option>";
        }
        $Cmb = $Cmb."</select>";
        return $Cmb;
    }

    function CmbCualquieraVtas($sPuesto,$sDepto){
        try{ 
            $WebService="http://dwh.taycosa.mx/WEB_SERVICES/DataLogs.asmx?wsdl";
            //parametros de la llamada
            $parametros = array();
            $parametros['sPuesto'] = $sPuesto;
            $parametros['sDepto'] = $sDepto;
            //Invocación al web service
            $WS = new SoapClient($WebService,$parametros);
            //recibimos la respuesta dentro de un objeto
            $result = $WS->CmbCualquieraVtas($parametros);
            $xml = $result->CmbCualquieraVtasResult->any;
            $obj = simplexml_load_string($xml);
            $Datos = $obj->NewDataSet->Table;
        } catch(SoapFault $e){
          var_dump($e);
        }
        $Cmb = "<select id='CmbMECAVENTAS' name='CmbMECAVENTAS' class='form-control'><option value='0'>TODO CmbMECAVENTAS</option>"; 
         for($i=0; $i<count($Datos); $i++){
            $Cmb = $Cmb."<option class='col-sm-12' value='".$Datos[$i]->id_empleado."'>".$Datos[$i]->Nombre."</option>";
        }
        $Cmb = $Cmb."</select>";
        return $Cmb;
    }

    function CmbCualquieraNomb($sID,$sNombre,$sTabla){
        try{ 
            $WebService="http://dwh.taycosa.mx/WEB_SERVICES/DataLogs.asmx?wsdl";
            //parametros de la llamada
            $parametros = array();
            $parametros['sID'] = $sID;
            $parametros['sNombre'] = $sNombre;
            $parametros['sTabla'] = $sTabla;
            //Invocación al web service
            $WS = new SoapClient($WebService,$parametros);
            //recibimos la respuesta dentro de un objeto
            $result = $WS->CmbCualquiera($parametros);
            $xml = $result->CmbCualquieraResult->any;
            $obj = simplexml_load_string($xml);
            $Datos = $obj->NewDataSet->Table;
        } catch(SoapFault $e){
          var_dump($e);
        }
        $Cmb = "<select id='Cmb".$sTabla."' name='Cmb".$sTabla."' class='form-control'><option value='0'>TODO (".$sTabla.")</option>"; 
         for($i=0; $i<count($Datos); $i++){
            $Cmb = $Cmb."<option class='col-sm-12'>".$Datos[$i]->$sNombre."</option>";
        }
        $Cmb = $Cmb."</select>";
        return $Cmb;
    }

    function CmbCualquierasMod($sID,$sNombre,$sTabla,$Text,$Value){
        try{ 
            $WebService="http://dwh.taycosa.mx/WEB_SERVICES/DataLogs.asmx?wsdl";
            //parametros de la llamada
            $parametros = array();
            $parametros['sID'] = $sID;
            $parametros['sNombre'] = $sNombre;
            $parametros['sTabla'] = $sTabla;
            //Invocación al web service
            $WS = new SoapClient($WebService,$parametros);
            //recibimos la respuesta dentro de un objeto
            $result = $WS->CmbCualquiera($parametros);
            $xml = $result->CmbCualquieraResult->any;
            $obj = simplexml_load_string($xml);
            $Datos = $obj->NewDataSet->Table;
        } catch(SoapFault $e){
          var_dump($e);
        }
        $Cmb = "<select id='Cmb".$sTabla."' name='Cmb".$sTabla."' class='form-control col-sm-12'><option value='".$Value."'>".$Text."</option>"; 
         for($i=0; $i<count($Datos); $i++){
            $Cmb = $Cmb."<option class='col-sm-12' value='".$Datos[$i]->$sID."'>".$Datos[$i]->$sNombre."</option>";
        }
        $Cmb = $Cmb."</select>";
        return $Cmb;
    }

    function CmbCualquierasId($sID,$sNombre,$sTabla,$IdCmb,$Value){
        try{ 
            $WebService="http://dwh.taycosa.mx/WEB_SERVICES/DataLogs.asmx?wsdl";
            //parametros de la llamada
            $parametros = array();
            $parametros['sID'] = $sID;
            $parametros['sNombre'] = $sNombre;
            $parametros['sTabla'] = $sTabla;
            //Invocación al web service
            $WS = new SoapClient($WebService,$parametros);
            //recibimos la respuesta dentro de un objeto
            $result = $WS->CmbCualquiera($parametros);
            $xml = $result->CmbCualquieraResult->any;
            $obj = simplexml_load_string($xml);
            $Datos = $obj->NewDataSet->Table;
        } catch(SoapFault $e){
          var_dump($e);
        }
        $Cmb = "<select id='Cmb".$IdCmb."' name='Cmb".$IdCmb."' class='form-control col-sm-12'><option value='".$Value."'>".$IdCmb."</option>"; 
         for($i=0; $i<count($Datos); $i++){
            $Cmb = $Cmb."<option class='col-sm-12' value='".$Datos[$i]->$sID."'>".$Datos[$i]->$sNombre."</option>";
        }
        $Cmb = $Cmb."</select>";
        return $Cmb;
    }
    function Cabecera(){
        echo '<head>';
        echo '<title id="title"></title>';
        echo '<meta charset=utf-8>';
        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> ';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">';
        echo '<meta name="description" content="" />';
        echo '<meta name="keywords" content="" />';
        echo '<meta name="author" content="TAYCO SA DE CV" />';
        echo '<link rel="stylesheet" type="text/css" href="../css/normalize.css" />';
        echo '<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"  />';
        echo '<link rel="stylesheet" type="text/css" href="../css/CargaGif.css"  />';
        echo '<link rel="stylesheet" type="text/css" href="../css/cosas.css"  />';
        echo '<link rel="shortcut icon" href="favicon.ico">';
        echo '</head>';
    }

    function Script(){
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
        echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';

    }

    function CargaGif(){
        echo "<div id='CargaGif' class='lds-css ng-scope'><div style='width:100%;height:100%' class='lds-double-ring'><div></div><div></div></div></div>";
    }

?>