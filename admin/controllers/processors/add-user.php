<?php

require_once 'init.php';
require_once '../classes/user.class.php';


$user = new User;

$user->addUser($_POST, $_FILES);











?>