<?php 
    session_start();
   
require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Theme;

$theme = new Theme;

$theme->id = $_GET['themeid'];

$info = $theme->getThemesById();


if(isset($_POST['edit'])){

    $theme->title = $_POST['title'];

    $theme->description = $_POST['description'];

    $theme->editThemes();

    header("Location: ./admin.php");
    exit;
}

print_r($info);

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
            <h1 class="text-2xl font-bold mb-6">Edit Theme</h1>

            <form method="POST" class="space-y-4">

                <div>
                    <label class="block mb-1">Title</label>
                    <input type="text" name="title"
                        value="<?= htmlspecialchars($info[0]['title']) ?>"
                        class="w-full px-4 py-2 rounded bg-gray-700"
                        required>
                </div>

                <div>
                    <textarea name="description" class="w-full px-4 py-2 rounded bg-gray-700" placeholder="Description"><?= htmlspecialchars($info[0]['description']) ?></textarea>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="./admin.php" class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded">Cancel</a>
                    <button name="edit" type="submit"
                            class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded">
                        Update Theme
                    </button>
                </div>
            </form>
        </div>
    </div> 
</body>
</html>