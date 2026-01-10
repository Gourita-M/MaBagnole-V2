<?php

namespace code\controlls;

require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Reservation;
use code\models\Review;
use code\models\Vehicles;
use code\models\Category;
use code\models\Theme;
use code\models\Comments;

$themes = new Theme;
$reservation = new Reservation;
$review = new Review;
$Vehicles = new Vehicles;
$category = new Category;
$comments = new Comments;

$vehicledata = $Vehicles->getVehicle();
$categorydata = $category->getCategories();
$reserdata = $reservation->getReservationByVehicle();
$commentsdata = $comments->getComments();

$revidate = $review->getReviewsWithVehicles();

$listthemes = $themes->getThemes();

if(isset($_POST['addtheme'])){

    $themes->title = $_POST['theme_name'];
    $themes->description = $_POST['description'];
    $themes->addTheme();

    header("Location: ./admin.php");

}

if(isset($_POST['deletecomment'])){

    $comments->id = $_POST['commentid'];

    $comments->deleteComments();

    header("Location: ./admin.php");
}
?>