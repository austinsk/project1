<?php
require_once('init.php');
echo password_hash('password', PASSWORD_DEFAULT, array('cost'=> 10) );
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$ref = $_SERVER['HTTP_REFERER'];
if(empty($username)){
    $_SESSION['error']='please enter your username';
    header("Location: $ref");
}

if(empty($password)){
    $_SESSION['error']='please enter your password';
    header("Location: $ref");
}

$sql = "SELECT * FROM admin WHERE user= :username ";
$result = $database->prepare($sql);
$result->bindValue('username', $username, PDO::PARAM_STR);
$result->execute();
if( $result->rowCount() == 1){
    $data=$result->fetch(PDO::FETCH_OBJ);
    if( password_verify($password, $data->password)){
        $_SESSION['userid']=$data->id;
   
        $_SESSION['username']=$data->username;
        header("Location: ../../dashboard.php");
    } else{
        $_SESSION['error']='invalid username and password';
        header("Location: $ref");
                        
    }
} else{
    $_SESSION['error']='invalid username';
    header("Location: $ref");
    
}


?>