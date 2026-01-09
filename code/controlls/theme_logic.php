<?php

namespace code\controlls;

require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Theme;
use code\models\Article;
use code\models\Tags;

$gethemes = new Theme;
$getarticlestheme = new Article;
$tags = new Tags;

$getarticlestheme->id = $_GET['id'];

$daata = $getarticlestheme->getArticlesAndThemeName();

$data = $gethemes->getThemes();

$alltags = $tags->getTags();



?>