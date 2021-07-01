<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
require_once 'init.php';


$sql = "SELECT id, name, description, path, thumb FROM services WHERE active = 1 AND id !=10";
$result = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);

 echo json_encode($result);
die();

?>



