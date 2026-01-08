<?php

namespace code\controlls;

require_once __DIR__ . '/../../vendor/autoload.php';
    
use code\models\Review;


    $review = new Review;

    $data = $review->getByVehicleid($_GET['id']);

?>