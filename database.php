<?php
 session_start();
 error_reporting(E_WARNING | E_ERROR);
 define('SERVER', 'live');

 switch (SERVER){
    	case 'local':

    $host = 'localhost';
    $dbname = 'aeria_app_be';
    $user = 'root';
    $password = '';

    	break;

    	case 'live':
    $host = 'aeria-app.be.mysql';
    $dbname = 'aeria_app_be';
    $user = 'aeria_app_be';
    $password = 'monmdp';

    	break;
    }



	try {
		$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (PDOException $e) {
		echo('Error: '.$e->getMessage());
	}

?>