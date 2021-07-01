<?php
require_once('init.php');

require_once('../classes/profile.class.php');
require_once '../lib/ImageResize.php';
require_once '../lib/picture.class.php';


$profile = new Profile;
$profile->updateProfile($_POST, $_FILES);


?>