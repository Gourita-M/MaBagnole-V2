<?php

namespace code\controlls;

require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Vehicles;

$vehicle = new Vehicles();

$result = $vehicle->getVehicle();

echo json_encode($result);

?>