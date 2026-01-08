<?php 
    session_start();

require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Comments;

$commentdele = new Comments;

$commentdele->id = $_GET['id'];
$info = $commentdele->getCommentsById();

$idd = $info[0]['article_id'];

if(isset($_POST['delete'])){
    

    $commentdele->softDelete();

    header("Location: ./article.php?id=$idd");
}

print_r($info);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Review</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php include_once "./header.php"; ?>

    <div class="bg-gray-100 flex items-center justify-center min-h-screen">

        <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold text-red-600 mb-4">Delete Comment</h1>

            <p class="text-gray-700 mb-4">
                Are you sure you want to delete this Comment
            </p>

            <div class="bg-gray-50 p-4 rounded mb-6">
                <p class="text-sm text-gray-600 mt-2">
                    <strong>Comment:</strong><br>
                    <?= htmlspecialchars($info[0]['content']) ?>
                </p>
            </div>

            <form method="POST" class="flex justify-between">
 
                <a href="./article.php?id=<?= htmlspecialchars($info[0]['article_id']) ?>"
                class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-black">
                    Cancel
                </a>

                <button type="submit" name='delete'
                        class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white">
                    Yes, Delete
                </button>
            </form>
        </div>

    </div>

<footer class="bg-gray-800 text-gray-400 py-6 text-center">
  © 2025 MaBagnole. All rights reserved.
</footer>
</body>
</html>