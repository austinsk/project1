<?php
require_once('init.php');

require_once('../classes/user.class.php');
require_once '../lib/ImageResize.php';
require_once '../lib/picture.class.php';


$user = new User;
$user->updateNewUserPassword();


?>