<?php
  session_start();
  include_once "../controlls/rented_logic.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Rentals & Reviews | MaBagnole</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">

<?php include_once "./header.php"; ?>

<div id="deleteReviewModal"
     class="fixed inset-0 hidden z-50
            bg-black/60
            flex items-center justify-center">

  <div class="bg-gray-800 w-full max-w-sm rounded-xl shadow-xl p-6 text-center">
    <h2 class="text-2xl font-bold text-red-400 mb-3">
      Delete Review
    </h2>

    <p class="text-gray-300 mb-6">
      Are you sure you want to delete this review?
    </p>

    <div class="flex justify-center gap-4">
      <button
        onclick="closeDeleteModal()"
        class="px-4 py-2 rounded bg-gray-600 hover:bg-gray-500">
        Cancel
      </button>

      <button
        class="px-4 py-2 rounded bg-red-500 text-white font-semibold hover:bg-red-400">
        Delete
      </button>
    </div>
  </div>
</div>

<!-- EDIT REVIEW MODAL -->
<div id="editReviewModal"
     class="fixed inset-0 hidden z-50
            bg-black/60
            flex items-center justify-center">

  <div class="bg-gray-800 w-full max-w-md rounded-xl shadow-xl p-6">
    <h2 class="text-2xl font-bold text-yellow-400 mb-4 text-center">
      Edit Your Review
    </h2>

    <form class="space-y-4">
      <!-- Rating -->
      <select
        class="w-full bg-gray-700 text-yellow-400 px-3 py-2 rounded border border-gray-600">
        <option value="1">1 ⭐</option>
        <option value="2">2 ⭐⭐</option>
        <option value="3">3 ⭐⭐⭐</option>
        <option value="4">4 ⭐⭐⭐⭐</option>
        <option value="5">5 ⭐⭐⭐⭐⭐</option>
      </select>

      <!-- Comment -->
      <textarea
        rows="4"
        class="w-full bg-gray-700 text-gray-100 px-3 py-2 rounded border border-gray-600 focus:ring-1 focus:ring-yellow-500 outline-none"
        placeholder="Update your review..."></textarea>

      <!-- Buttons -->
      <div class="flex justify-end gap-3">
        <button type="button"
          onclick="closeEditModal()"
          class="px-4 py-2 rounded bg-gray-600 hover:bg-gray-500">
          Cancel
        </button>

        <button
          class="px-4 py-2 rounded bg-yellow-500 text-black font-semibold hover:bg-yellow-400">
          Save
        </button>
      </div>
    </form>
  </div>
</div>


<!-- MAIN -->
<main class="flex-grow max-w-7xl mx-auto px-6 py-10">

  <h2 class="text-4xl font-bold mb-8 text-yellow-400">My Rented Vehicles & Reviews</h2>

  <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 ">

    <?php 
      foreach($data as $da){
        echo "
          <article class='bg-gray-800 rounded-lg shadow p-5 flex flex-col'>
            <img
              src='{$da['Vehicle_image']}'
              class='w-full h-40 rounded-md object-cover mb-4'
            />

            <h3 class='text-xl font-semibold text-yellow-400 mb-1'>{$da['model']}</h3>
            <p class='text-sm text-gray-300 mb-1'>Category: {$da['cate_name']}</p>
            <p class='text-sm text-gray-300 mb-2'>Rented: {$da['start_date']} → {$da['end_date']}</p>

        ";

          if($da['reviews_comment'] != null ){
            echo "
              <div class='bg-gray-900 rounded p-3 mb-2'>
                <h4 class='text-yellow-400 font-semibold mb-1'>Your Review</h4>
                <span class='text-yellow-400 mr-2'>{$da['rating']} / 5</span>
                <div class='flex items-center mb-2'>
                  <a href='./edit_review.php?id={$da['reviews_id']}' class='text-blue-400 hover:underline mr-3'>Edit</a>
                  <a href='./delete_review.php?id={$da['reviews_id']}' class='text-red-500 hover:underline'>Delete</a>
                </div>
                <p class='text-gray-300'>{$da['reviews_comment']}.</p>
              </div>
            ";
            }else{
              echo "
              <form method='POST' class='flex flex-col gap-3'>
                <label class='text-yellow-400 font-semibold'>Add Your Review</label>
                <input type='hidden' name='vehiid' value='{$da['vehicle_id']}'>
                <select
                  class='bg-gray-700 text-yellow-400 rounded px-3 py-2 border border-gray-600 focus:ring-2 focus:ring-yellow-500 outline-none'
                  required
                  name='rating'
                >
                  <option value='' disabled selected>Rate</option>
                  <option value='1'>1</option>
                  <option value='2'>2</option>
                  <option value='3'>3</option>
                  <option value='4'>4</option>
                  <option value='5'>5</option>
                </select>

                <textarea
                  name='review'
                  rows='3'
                  placeholder='Write your review...'
                  class='bg-gray-700 text-yellow-400 rounded px-3 py-2 border border-gray-600 resize-none focus:ring-2 focus:ring-yellow-500 outline-none'
                  required
                ></textarea>

                <button
                  name='subreview'
                  type='submit'
                  class='bg-yellow-500 text-black font-semibold px-4 py-2 rounded hover:bg-yellow-400 transition'
                >
                  Submit Review
                </button>
              </form>
            ";}
        echo "
          </article>
        ";
    }
    ?>
    
  </section>
</main>

<!-- FOOTER -->
<footer class="bg-gray-800 text-gray-400 py-6 text-center">
  © 2025 MaBagnole. All rights reserved.
</footer>

</body>
</html>
