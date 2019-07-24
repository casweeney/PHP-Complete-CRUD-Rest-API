<?php
	//Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, REQUEST');
	header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Mehtods, Authorization, X-Requested-With');

    ob_start();
	session_start();

	ini_set('error_reporting', 1);
	error_reporting(1);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
    
?>