<?php
//id_vendedor
//vendedor
//sucursal
//puntuacion (con condicion sacar si aprobo o no)
//modulo


    $num = md5(time());
    $ipvisitante = $_SERVER["REMOTE_ADDR"];
    $host = gethostbyaddr( $_SERVER['REMOTE_ADDR'] );
    $browser_type = getenv("HTTP_USER_AGENT");
    $NomVendedor = $_POST['txtnomb'];
    $IdVendedor = $_POST['txtid'];
    $Puntos = $_POST['txtpuntos'];
    //MAIL BODY
    $body = "
    <html>
    <head>
    <title>Avisos</title>
    </head>
    <body style='background:#EEE; padding:30px;'>
    <h2 style='color:#767676;'>Contacto mediante la pagina!</h2><br>";

    if ($Puntos >= 8){
        $body .= "
        <strong style='width: 60px; text-align: right;'>Buenos dias: </strong><br>
        <span style='color:#767676;'>Nos es grato anunciar que el usuario <strong>" . $NomVendedor . " </strong><strong style='color: GREEN;'>APROBO</STRONG> con " . $Puntos . " puntos el curso ISOCLEAN modulo 1 satisfactoriamente hoy " . date("Y-m-d H:i:s") . ".</span><br>";    
    }
    if ($Puntos < 8){
        $body .= "
        <strong style='width: 60px; text-align: right;'>Buenos dias: </strong><br>
        <span style='color:#767676;'>Lamentamos anunciar que el usuario <strong>" . $NomVendedor . " </strong><strong style='color: RED;'>REPROBO</STRONG> con " . $Puntos . " puntos el curso ISOCLEAN modulo 1 hoy " . date("Y-m-d H:i:s") . ".</span><br>";    
    }

    $body .= "
    <span style='color:#767676; font-size: 8px;'>" . "Informacion adicional - IP:" . $ipvisitante . " - HOST:" . $host . " - NAVEGADOR:" . $browser_type . "</span><br>";

    $body .= "</body></html>";

    $headers = "From: Eimportacion sitio web pagina@eimportacion.com.mx \r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    //$headers .= 'Bcc: ghernandez@eimportacion.com.mx, jrubio@eimportacion.com.mx' . "\r\n";
    @mail("acampuzano1@eimportacion.com.mx","Contacto mediante la pagina!" , $body, $headers);

?>