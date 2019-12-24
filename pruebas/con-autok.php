<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <!--- basic page needs ================================================== -->
    <meta charset="utf-8">
    <title>EAGLE IMPORTACION</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS ================================================== -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- favicons ================================================== -->
<!--    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">-->

</head>
<?php

    $Id_Autorizacion = $_GET['p1'];
    $Orden = $_GET['p2'];
    $Respuesta = 'SI';
    $sTipo = 0;
    $iError = 0;
    $msg = '';

    include('http://ws.eimportacion.com.mx/nvo-autok.php?x1='.$Id_Autorizacion.'&x2='.$Orden.'&x3='.$Respuesta.'&x4='.$sTipo.'&x5='.$iError.'&x6='.$iError.'');
?>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>