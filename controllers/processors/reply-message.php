<?php require_once 'init.php';
require_once '../classes/message.class.php';


$message=new Message;



$message->replyMessage($_POST);
go();

 ?>