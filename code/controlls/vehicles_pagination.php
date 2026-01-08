<?php 

namespace code\controlls;

require_once __DIR__ . '/../../vendor/autoload.php';
   
use code\models\Vehicles;


    $vehicle = new Vehicles;
    $vehicles = $vehicle->getVehicleCategory();

?>