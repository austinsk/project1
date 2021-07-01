<?php session_start();
require_once('../../config/constants.php');
require_once('../lib/functions.php');
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('PHP version error occurred. Pls contact Admin');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
  require_once('../auth/libraries/password_compatibility_library.php');
}
require_once('../lib/pdo_connection.php');
// require_once('../lib/upload.class.php');
require_once('../auth/classes/Login.php');

//require_once ('../classes/notification.class.php');


 ?>