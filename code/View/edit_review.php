<?php 
    session_start();
    include_once "../config/database.php";
    include_once "../models/Review.php";
   
use code\models\Review;

    $reviews = new Review;

    $reviews->review_id = $_GET['id'];

    $review = $reviews->getReviewsById();

    if(isset($_POST['edit'])){

        $reviews->rating = $_POST['rating'];
        $reviews->reviews_comment = $_POST['comment'];
        
        $reviews->editReview();

        header("Location: ./rented.php");

        exit;
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

<div class="bg-gray-900 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Edit Review</h1>

    <form method="POST">
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Rating</label>
            <select name="rating" class="w-full border rounded px-3 py-2">
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 mb-2">Comment</label>
            <textarea name="comment" rows="4"
                      class="w-full border rounded px-3 py-2"
                      required><?= htmlspecialchars($review['reviews_comment']) ?></textarea>
        </div>

        <div class="flex justify-between">
            <a href="./rented.php"
               class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-black">
                Cancel
            </a>

            <button type="submit" name="edit"
                    class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">
                Update Review
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