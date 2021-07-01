<?php
ob_start();
session_start();

define("GREETING", "Welcome to handyGuys.com!");
$database = new PDO('mysql:host=localhost;dbname=positiveradioonline', 'root', '');
?>