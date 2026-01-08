<?php
namespace code\controlls;

session_start();
require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Article;
use code\models\Comments;
use code\models\Tags;

$errormessage = '';

$artcomm = new Article;
$comments = new Comments;
$tagss = new Tags;

$artcomm->id = $_GET['id'];
$comments->id = $_GET['id'];

$datao = $artcomm->getArticles();
$commdata = $comments->getCommentUserName();
$tagsnames = $tagss->getTags();

if(isset($_POST['comment'])){

    $comments->content = $_POST['content'];

   $result = $comments->addComments($_GET['id'], $_SESSION['userid']);
    
   if($result)
    header("Location: ./article.php?id={$_GET['id']}");
        else
            $errormessage = "You Have A Problem with your Comment";
}

?>