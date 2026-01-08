<?php

namespace code\controlls;

require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Reservation;
use code\models\Vehicles;


    $vehicle = new Vehicles;
    $reservetion = new Reservation;

    $datavehicle = $vehicle->findVehicleById($_GET['id']);
 
    if(isset($_POST['reserve'])){
        
        $reservetion->vehicleid = $_GET['id'];
        $reservetion->start_date = $_POST['pickup'];
        $reservetion->end_date = $_POST['back'];
        $reservetion->location = $_POST['picklocation'];

        $result = $reservetion->createReservation($_SESSION['userid']);

        if($result){
            header("Location: ../View/rented.php");
            exit();
        }

    }
    
?>