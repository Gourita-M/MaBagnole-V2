<?php

namespace code\controlls;
 
require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\user;

    $users = new User();

//login

    if(isset($_POST['login'])){
        
        $users->setEmail($_POST['email']);
        $users->setPassword($_POST['password']);

        $result = $users->login();

        if($result === true){
            $_SESSION['userid'] = $users->getUserId();
            $_SESSION['username'] = $users->getName();
            $_SESSION['role'] = $users->getRole();
        }
        else{
            echo "Wrong Email or Password";
        }
    }

//Register

    if(isset($_POST['register'])){

        $users->setName($_POST['name']);
        $users->setEmail($_POST['email']);
        $users->setPassword($_POST['password']);

        echo $users->getName();

        $result = $users->register();

        if($result === false){
            echo "Email is already in use";
        }
    }

?>