<?php 
    session_start();
   
require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Vehicles;
use code\models\Category;

$error = '';
echo $error;

$editVehicle = new Vehicles;
$categoryies = new Category;

$catego = $categoryies->getCategories();
$info = $editVehicle->findVehicleById($_GET['vehicleid']);

if(isset($_POST['edit'])){

            $editVehicle->model = $_POST['model'];
            $editVehicle->price_day = $_POST['price_day'];
            $editVehicle->vehicle_status = $_POST['status'];
            $editVehicle->Vehicle_image = $_POST['image'];


    $result = $editVehicle->editVehicle($_GET['vehicleid']);

    if(!$result)
        $error = $result;
    header("Location: ./admin.php");
    exit;
}

print_r($catego);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Vehicle</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include_once "./header.php"; ?>
    <div class="bg-gray-900 text-white min-h-screen flex items-center justify-center">

        <div class="bg-gray-800 p-8 rounded-lg w-full max-w-lg">
            <h1 class="text-2xl font-bold mb-6">Edit Vehicle</h1>

            <form method="POST" class="space-y-4">

                <div>
                    <label class="block mb-1">Model</label>
                    <input type="text" name="model"
                        value="<?= htmlspecialchars($info['model']) ?>"
                        class="w-full px-4 py-2 rounded bg-gray-700"
                        required>
                </div>

                <div>
                    <label class="block mb-1">Price per day (€)</label>
                    <input type="number" name="price_day"
                        value="<?= $info['price_day'] ?>"
                        class="w-full px-4 py-2 rounded bg-gray-700"
                        required>
                </div>

                <div>
                    <label class="block mb-1">Category</label>
                    <select name="category_id" class="w-full px-4 py-2 rounded bg-gray-700">
                        
                        <option value="">
                            Select Category
                        </option>
                        <?php foreach($catego as $ca): ?>
                        <option value="<?= htmlspecialchars($ca['id']) ?>">
                            <?= htmlspecialchars($ca['cate_name']) ?>
                        </option>
                        <?php endforeach; ?>
                        
                    </select>
                </div>

                <div>
                    <label class="block mb-1">Status</label>
                    <select name="status" class="w-full px-4 py-2 rounded bg-gray-700">
                        <option value="">
                            Select Status
                        </option>
                        <option value="Availbale">
                            Availbale
                        </option>
                        <option value="unavailable">
                            unavailable
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1">Vehicle Image ( URL )</label>
                    <input type="text" name="image"
                        value="<?= $info['Vehicle_image'] ?>"
                        class="w-full px-4 py-2 rounded bg-gray-700"
                        required>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="./admin.php" class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded">Cancel</a>
                    <button name="edit" type="submit"
                            class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded">
                        Update Vehicle
                    </button>
                </div>
            </form>
        </div>
    </div> 
</body>
</html>