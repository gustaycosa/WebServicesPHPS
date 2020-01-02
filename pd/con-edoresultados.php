<?php
    ini_set('max_execution_time', 60000);  
    ini_set("default_socket_timeout", 60000);  
    ini_set('memory_limit','256M');   
    ini_set('mysql.connect_timeout', 60000);  
    ini_set('user_ini.cache_ttl', 60000);  
    ini_set('display_errors',0);    
    ini_set('log_errors',1);    
    error_reporting(E_ALL);

        $myparams['Empresa'] = 'EAGLE';
        $myparams['Mes'] = $_POST["TxtMes"]; 
        $myparams['Ejercicio'] = $_POST["TxtEjercicio"];
    
    include('http://192.168.20.130/tabla-edoresultados.php');
?>