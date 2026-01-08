<?php

namespace code\controlls;

require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Reservation;
use code\models\Review;
use code\models\Vehicles;
use code\models\Category;

$reservation = new Reservation;
$review = new Review;
$Vehicles = new Vehicles;
$category = new Category;

$vehicledata = $Vehicles->getVehicle();
$categorydata = $category->getCategories();
$reserdata = $reservation->getReservationByVehicle();

$revidate = $review->getReviewsWithVehicles();


?>