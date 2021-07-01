<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
require_once 'config.php';

$id = $_GET['id'];


$sql = "SELECT id, name, path FROM categories WHERE service_id = $id";
$result = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);

 echo json_encode($result);
die();

?>



