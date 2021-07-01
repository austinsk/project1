<?php

require_once 'init.php';
require_once '../classes/profile.class.php';


$profile = new Profile;


$profile->updateProfile($_POST, $_FILES);















?>