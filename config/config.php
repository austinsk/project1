<?php

// Database Constants
define("DB_HOST", "127.0.0.1");
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "yokeus");
define("CRYPT_KEY", "4486d3528378bb3fece448d3903bcaa823b7cd09");
define("PATH", "http://localhost:8888/yokeus/");
define("SITE", "acefacility/");
define('SITE_ROOT', __DIR__);
// define("SERVER_PATH", "C:\\xampp\\htdocs\\acefacility\\");

$mysqli = new mysqli(DB_HOST, DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if($mysqli === false){
   die("ERROR: Could not connect. " . $mysqli->connect_error);
}

 ?>
