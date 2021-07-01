<?php
date_default_timezone_set("Africa/Lagos");
try{
$database = new PDO("mysql:host=" . DB_SERVER . ";dbname=" .DB_NAME . "",'' . DB_USER . '','' .DB_PASS . '');

//$database = new PDO("mysql:host=DB_SERVER;dbname=compsci",'DB_USER','DB_PASS');
} catch(PDOException $e)
{
echo $e->getMessage();
	}
	
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$database->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);



 ?>