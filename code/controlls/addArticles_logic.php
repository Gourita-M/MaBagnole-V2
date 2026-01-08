<?php

namespace code\controlls;

session_start();
require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Article;
use code\models\Theme;
use code\models\Tags;

    $themename = new Theme;
    $articles = new Article;
    $tag = new Tags;

    $tagsnames = $tag->getTags();

    $themename->id = $_GET['theme_id'];

    $theme = $themename->getThemesById();

    if(isset($_POST['addarticle'])){
        
        $articles->title = $_POST['title'];
        $articles->content = $_POST['content'];
        $articles->urlmedia = $_POST['media'];
        
        $result = $articles->addArticle($_SESSION['userid'], $_GET['theme_id']);

        $artid = $articles->getLastArticle();
    
        $tags = $_POST['tags'];

        foreach($tags as $tas){

            $articles->addArtcleTag($artid[0]['id'], $tas);
        }

        header("Location: ./addArtcle.php?theme_id=$themename->id");

    }
    
    

?>