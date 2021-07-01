<?php 
ob_start();
session_start();
require_once('../config/constants.php');
require_once('../controllers/lib/functions.php');

// die('test');

require_once('../controllers/lib/pdo_connection.php');
require_once('../controllers/lib/picture.class.php');
require_once('../controllers/lib/ImageResize.php');
// require_once('../lib/upload.class.php');
require_once('../controllers/auth/classes/Login.php');

//require_once ('../classes/notification.class.php');


 ?>