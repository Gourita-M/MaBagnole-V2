<?php
namespace code\controlls;

require_once __DIR__ . '/../../vendor/autoload.php';

session_start();
 
use code\models\user;

    $users = new User();

    $users->logOut();

    header("Location: ../index.php");

    exit;

?>