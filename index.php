<?php
header('Access-Control-Allow-Origin: http://localhost:3001');
header('Access-Control-Allow-Credentials: true');

require_once("librairies/autoload.php");

session_start();
    
Main::start();