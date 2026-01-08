<?php 
    session_start();
   
require_once __DIR__ . '/../../vendor/autoload.php';

use code\models\Comments;

$editcomments = new Comments;

$editcomments->id = $_GET['id'];

$info = $editcomments->getCommentsById();

$idd = $info[0]['article_id'];

print_r($info);

if(isset($_POST['edit'])){

    $editcomments->content = $_POST['comment'];

    $editcomments->editComment();

    header("Location: ./article.php?id=$idd");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Review</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<?php include_once "./header.php"; ?>

<div class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Edit Comment</h1>

    <form method="POST">
    
        <div class="mb-6">
            <label class="block text-gray-700 mb-2">Comment</label>
            <textarea name="comment" rows="4"
                      class="w-full border rounded px-3 py-2"
                      required><?= htmlspecialchars($info[0]['content']) ?></textarea>
        </div>

        <div class="flex justify-between">
            <a href="./article.php?id=<?= htmlspecialchars($info[0]['article_id']) ?>"
               class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-black">
                Cancel
            </a>

            <button type="submit" name="edit"
                    class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">
                Update
            </button>
        </div>
    </form>
</div>

</div>
<footer class="bg-gray-800 text-gray-400 py-6 text-center">
  © 2025 MaBagnole. All rights reserved.
</footer>
</body>
</html>