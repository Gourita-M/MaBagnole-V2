<?php

namespace code\controlls;

require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Theme;
use code\models\Article;

$gethemes = new Theme;
$getarticlestheme = new Article;

$data = $gethemes->getThemes();



?>