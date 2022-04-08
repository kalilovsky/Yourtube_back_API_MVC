<?php
header('Access-Control-Allow-Origin: https://urtubereactjs.herokuapp.com/');
// header('Access-Control-Allow-Origin: http://localhost:46059/');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset=utf-8');


require_once("librairies/autoload.php");

session_start();
    
Main::start();