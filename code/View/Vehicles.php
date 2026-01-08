<?php 
  session_start();

  include_once "../controlls/vehicles_pagination.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>MaBagnole | Car Rental</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
</head>
<body class="bg-gray-900 text-gray-100">

<?php include_once "./header.php"; ?>
<!-- AUTH MODAL -->
<div id="auth-modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center hidden z-50">
  <div class="bg-gray-800 rounded-xl shadow-2xl w-full max-w-md p-6 relative text-gray-100">

    <button id="close-auth-modal"
      class="absolute top-3 right-3 text-gray-400 hover:text-white text-2xl">&times;</button>

    <!-- LOGIN -->
    <div id="login-form">
      <h2 class="text-2xl font-bold mb-6 text-center text-yellow-400">Login</h2>
      <form method="POST">
        <input name="email" type="email" placeholder="Email"
          class="w-full mb-4 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 outline-none" />

        <input name="password" type="password" placeholder="Password"
          class="w-full mb-6 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 outline-none" />

        <button name="login" type="submit"
          class="w-full bg-yellow-500 text-black py-3 rounded-lg font-semibold hover:bg-yellow-400 transition">
          Login
        </button>
      </form>

      <p class="mt-4 text-center text-sm text-gray-400">
        Don’t have an account?
        <button id="show-register" class="text-yellow-400 hover:underline">Register</button>
      </p>
    </div>

    <!-- REGISTER -->
    <div id="register-form" class="hidden">
      <h2 class="text-2xl font-bold mb-6 text-center text-yellow-400">Register</h2>
      <form method="POST">
        <input name="name" type="text" placeholder="Username"
          class="w-full mb-4 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg" />

        <input name="email" type="email" placeholder="Email"
          class="w-full mb-4 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg" />

        <input name="password" type="password" placeholder="Password"
          class="w-full mb-6 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg" />

        <button name="register" type="submit"
          class="w-full bg-yellow-500 text-black py-3 rounded-lg font-semibold hover:bg-yellow-400 transition">
          Register
        </button>
      </form>

      <p class="mt-4 text-center text-sm text-gray-400">
        Already have an account?
        <button id="show-login" class="text-yellow-400 hover:underline">Login</button>
      </p>
    </div>
  </div>
</div>

<!-- CATEGORY FILTER -->
<section class="max-w-7xl mx-auto px-6 py-10">
  <h3 class="text-2xl font-bold mb-6 text-center text-yellow-400">
    Filter by Category
  </h3>

  <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

    <div data-category=""
      class="category-card bg-gray-800 rounded-xl p-4 text-center cursor-pointer
             hover:bg-gray-700 transition border border-transparent">
      All
    </div>

    <div data-category="Economy"
      class="category-card bg-gray-800 rounded-xl p-4 text-center cursor-pointer
             hover:bg-gray-700 transition border border-transparent">
      Economy
    </div>

    <div data-category="SUV"
      class="category-card bg-gray-800 rounded-xl p-4 text-center cursor-pointer
             hover:bg-gray-700 transition border border-transparent">
      SUV
    </div>

    <div data-category="Luxury"
      class="category-card bg-gray-800 rounded-xl p-4 text-center cursor-pointer
             hover:bg-gray-700 transition border border-transparent">
      Luxury
    </div>

    <div data-category="Motorbike"
      class="category-card bg-gray-800 rounded-xl p-4 text-center cursor-pointer
             hover:bg-gray-700 transition border border-transparent">
      Motorbike
    </div>

  </div>
</section>



<table id="vehiclesTable" class="display w-full text-center">
  <thead>
    <tr>
      <th>ID</th>
      <th>Model</th>
      <th>Category</th>
      <th>Price / Day</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($vehicles as $v): ?>
      <tr>
        <td><?= $v['vehicle_id'] ?></td>
        <td><?= $v['model'] ?></td>
        <td><?= $v['cate_name'] ?></td>
        <td><?= $v['price_day'] ?> DH</td>
        <td><?= $v['vehicle_status'] ?></td>
        <td>
          <a href="./Vehicle_details.php?id=<?= $v['vehicle_id'] ?>"
           class="mt-4 inline-block bg-yellow-500 text-black px-4 py-2 rounded-lg font-semibold
                  hover:bg-yellow-400 transition">
          View Details
        </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<!-- FOOTER -->
<footer class="bg-black text-gray-400">
  <div class="max-w-7xl mx-auto px-6 py-8 text-center">
    © 2025 MaBagnole. All rights reserved.
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {

  const table = $('#vehiclesTable').DataTable({
    pageLength: 5,
    lengthMenu: [5, 10, 25, 50],
    ordering: true,
    searching: true,
    info: true
  });

  $('.category-card').on('click', function () {

    $('.category-card').removeClass('border-yellow-400 text-yellow-400');
    $(this).addClass('border-yellow-400 text-yellow-400');

    const category = $(this).data('category');

    if (category) {
      table.column(2).search('^' + category + '$', true, false).draw();
    } else {
      table.column(2).search('').draw();
    }
  });

});
</script>
<style>
  .category-card.border-yellow-400 {
    box-shadow: 0 0 15px rgba(250, 204, 21, 0.4);
  }
</style>


</body>
</html>