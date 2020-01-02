
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
    
    include("head.php"); 
    echo Cabecera('PORTAL EAGLE');

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

    $myparams['sPerfil'] = $Perfil;
    $myparams['sModulo'] = 'DWH';
    $myparams['sTipoPerfil'] = $TipoPerfil;

    $procedure_params = array(
    array(&$myparams['sPerfil'], SQLSRV_PARAM_IN),
    array(&$myparams['sModulo'], SQLSRV_PARAM_IN),
    array(&$myparams['sTipoPerfil'], SQLSRV_PARAM_IN)
    );

    $query = "EXEC dbo.GOB_SP_Menu_Accesos @sPerfil = ?, @sModulo = ?, @sTipoPerfil = ?";

    $cadena = sqlsrv_query($conn, $query, $procedure_params);
    //echo $cadena;
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
    //style="background:url(images/back01.gif) center center no-repeat fixed white;background-size:cover;

        echo '<body class="body">
            <div id="navmenu">
              <ul class="nav navmenu-nav" style="background:black;">';
        $BANDERA = '';
        $i = 0;
        while( $row = sqlsrv_fetch_array($cadena)) {
            if(strcmp(utf8_encode($row["Grupo"]),$BANDERA) !== 0 && $i==0 ){
		      echo '<li><a id="'.utf8_encode($row["Grupo"]).'">'.utf8_encode($row["Grupo"]).'</a><ul class="'.utf8_encode($row["Grupo"]).'">';
                echo '<li><a id="'.utf8_encode($row["forma"]).'" target="'.utf8_encode($row["forma"]).'" class="list-group-item">'.utf8_encode($row["Descripcion"]).'</a></li>'; 
                $BANDERA = utf8_encode($row["Grupo"]);
            }elseif( strcmp(utf8_encode($row["Grupo"]),$BANDERA) !== 0){
                echo '</ul></li><li id="a'.$i.'"><a id="'.utf8_encode($row["Grupo"]).'" type="button">
                    '.utf8_encode($row["Grupo"]).'</a><ul class="'.utf8_encode($row["Grupo"]).'">';
                echo '<li><a id="'.utf8_encode($row["forma"]).'" target="'.utf8_encode($row["forma"]).'" class="list-group-item">'.utf8_encode($row["Descripcion"]).'</a></li>'; 
                $BANDERA = utf8_encode($row["Grupo"]);
            }else{
                echo '<li id="'.$i.'"><a id="'.utf8_encode($row["forma"]).'" target="'.utf8_encode($row["forma"]).'" class="list-group-item">'.utf8_encode($row["Descripcion"]).'</a></li>'; 
            }
            $i= $i + 1;
        }
                        echo '   
                    </ul></li>
                    <li><a href="salir.php" type="button" class="list-item">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar sesión
                    </a></li>
                  </ul>';

                echo '</div>
                <div>
                  <button  id="edo" target="edo"  type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" style=" background: #337ab7; left: 0px; position: fixed; z-index: 3;">
                    <span class="icon-bar" style="background:white;"></span>
                    <span class="icon-bar" style="background:white;"></span>
                    <span class="icon-bar" style="background:white;"></span>
                  </button>
                  <div id="divblock" style="    background: gray;
            width: 100%;
            height: 100%;
            position: absolute;
            display: none;
            opacity: 0.5;
            z-index: 2;"></div>
                </div>';
                echo '<div id="principal" class="container-fluid"></div></body>';
        echo'<style>
        ::selection { background: transparent;}
        ::-moz-selection { background: transparent; }
        </style>';
        include("barratareas.php");    
        echo Script();
    }
    else{
        $valido = 1;
        die( print_r( sqlsrv_errors(), true));
    }
    
 ?>
    <script type="text/javascript"> 
        var contador = 0;
        document.addEventListener('touchmove', function(e) {
            e.preventDefault();
            var touch = e.touches[0];
        }, false);
        
        $(document).on('click touchstart','.close',function(){
            var ID = $( this ).attr("name");
            $( "#navbar #"+ID ).remove();
            $( "#ifm"+ID ).remove();
        });

        
        $(document).on('click touchstart','.vna-act',function(){
            var ids = $( this ).attr("id");
            var idcomplete = '#ifm'+ids;
            $("#principal iframe").hide();
            $("#navbar a").attr('class').replace('vna-act', 'vna-min');
            $(this).removeClass( 'vna-act' ).addClass( 'vna-min' );
            $( idcomplete ).hide();
        });
        
        $(document).on('click touchstart','.vna-min',function(){
            var ids = $( this ).attr("id");
            var idcomplete = '#ifm'+ids;
			$("#navbar > a").removeClass('vna-act').addClass('vna-min');
			$("#principal iframe").hide();
			$(this).removeClass( 'vna-min' ).addClass( 'vna-act' );
            $( idcomplete ).show();
        });
        
        $(document).on('click touchstart','.list-group-item',function(){
            var modulo = $(this).parent().parent().attr('class').toLowerCase();
            var titulomin = $(this).text();
			$("#principal iframe").hide();
			$("#navbar > a").removeClass('vna-act').addClass('vna-min');
            var IDFRM = $( this ).attr("id");
            contador = contador + 1;
            var modal2 = "<iframe id='ifm"+IDFRM+"_"+contador+"' name='"+IDFRM+"' src='mod/"+modulo+"/"+IDFRM+".php?e="+<?php echo $Id_Usuario;?>+"&a=taycosa"+"' frameborder='0' class='col-sm-12 col-xs-12 col-md-12 col-lg-12'></iframe>";
            var ventana = "<a id='"+IDFRM+"_"+contador+"' class='vna-act'>"+titulomin+"<button class='close' name='"+IDFRM+"_"+contador+"'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></a>";
            $( "#principal" ).append( modal2 );
            $( "#navbar" ).append( ventana );
            $("#"+IDFRM+"_"+contador).attr('class').replace('vna-min', 'vna-act');
            $( "#ifm"+IDFRM+"_"+contador ).addClass('ifmOpen');
            
            $("#navmenu").hide();
            $("#navmenu").css("left","-300px");
            $("#divblock").hide();
            $("#edo").css("left","0px");
        });
        
        $(document).on('click touchstart','.list-item',function(){
			$("#principal iframe").hide();
			$("#navbar > a").removeClass('vna-act').addClass('vna-min');
            var IDFRM = $( this ).attr("id");
            var ID = $( this ).attr("id");
            var SRC = $( this ).attr("ref");
            contador = contador + 1;
            var modal2 = "<iframe id='ifm"+IDFRM+"' name='"+IDFRM+"' src='"+IDFRM+".php?e="+<?php echo $Id_Usuario;?>+"&a=taycosa"+"' frameborder='0' class='col-sm-12'></iframe>";
            var ventana = "<a id='"+IDFRM+"' class='vna-act'>"+IDFRM+"<button class='close' name='"+IDFRM+"_"+contador+"'>x</button></a>";
            $( "#principal" ).append( modal2 );
            $( "#navbar" ).append( ventana );
            $("#"+IDFRM).attr('class').replace('vna-min', 'vna-act');
            $( "#ifm"+IDFRM ).addClass('ifmOpen');
            
            $("#navmenu").hide();
            $("#navmenu").css("left","-300px");
            $("#divblock").hide();
            $("#edo").css("left","0px");
        });

        $(document).on('click touchstart','ul.nav li a',function(){
			var MenuItem = $( this ).attr("id");
			if ($("."+MenuItem).is(":hidden")) {
				$("ul.nav li ul").hide();
				$("."+MenuItem).show();
			}else{
				$("."+MenuItem).hide();
			}
        });
        
        $(document).on('click touchstart','#principal',function(){
                $("#navmenu").hide();
                $("#navmenu").css("left","-300px");
                $("#edo").css("left","0px");
        });
        
        $(document).on('click touchstart','#divblock',function(){
                $("#navmenu").hide();
                $("#navmenu").css("left","-300px");
                $("#divblock").hide();
                $("#edo").css("left","0px");
        });
        
        $(document).on('click touchstart','#edo',function(){
			if ($("#navmenu").is(":hidden")) {
                $("#navmenu").show();
                $("#divblock").show();
				$("#navmenu").css("left","0px");
                $("#edo").css("left","300px");
			}else{
                $("#navmenu").hide();
                $("#navmenu").css("left","-300px");
                $("#divblock").hide();
                $("#edo").css("left","0px");
			}
        });
        
        $(document).ready(function() {

        } );

    </script>
    <script language="JavaScript" type="text/javascript">
        function show5(){
            if (!document.layers&&!document.all&&!document.getElementById)
            return
             var Digital=new Date()
             var hours=Digital.getHours()
             var minutes=Digital.getMinutes()
             var seconds=Digital.getSeconds()
             var dn="PM"
             if (hours<12)
             dn="AM"
             if (hours>12)
             hours=hours-12
             if (hours==0)
             hours=12
             if (minutes<=9)
             minutes="0"+minutes
             if (seconds<=9)
             seconds="0"+seconds
            myclock=hours+":"+minutes+":"
             +seconds+" "+dn
            if (document.layers){
            document.layers.liveclock.document.write(myclock)
            document.layers.liveclock.document.close()
            }
            else if (document.all)
            liveclock.innerHTML=myclock
            else if (document.getElementById)
            document.getElementById("liveclock").innerHTML=myclock
            setTimeout("show5()",1000)
        }
        window.onload=show5
     </script>
</html>