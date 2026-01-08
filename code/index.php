<?php 
session_start();

require_once __DIR__ . "/../vendor/autoload.php";

include_once "./controlls/login_register.php";
include_once "./controlls/home_themes.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>MaBagnole | Car Rental</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100">

<header class="bg-gray-800 shadow-lg">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-yellow-400">MaBagnole</h1>

    <nav class="space-x-6 hidden md:block">
      <a href="./index.php" class="hover:text-yellow-400 text-white transition">Home</a>
      <?php 
      if(isset($_SESSION['role'])){
      if($_SESSION['role'] === 'admin'){
        echo '<a href="./View/admin.php" class="hover:text-yellow-400 text-white transition">Dashboard</a>';
      }else{
        echo '<a href="./View/rented.php" class="hover:text-yellow-400 text-white transition">Rented</a>
              <a href="./View/Vehicles.php" class="hover:text-yellow-400 text-white transition">Vehicles</a>
              <a href="./View/Themes.php" class="hover:text-yellow-400 text-white transition">Blog</a>';
      }
    }
    ?>
    </nav>

    <?php 
      if (isset($_SESSION['username'])){
        echo "
        <div class='flex items-center gap-4'>
          <span class='text-yellow-400 font-semibold'>
            👋 {$_SESSION['username']}
          </span>

          <a href='./controlls/logout.php'
            class='bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-400 transition'>
            Logout
          </a>
        </div> ";
      }else{
        echo "
        <button
          class='open-login-modal bg-yellow-500 text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition'>
          Login / Register
        </button>
        ";
      }
    ?>
    <button
        class='open-login-modal hidden bg-yellow-500 text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition'>
        Login / Register
      </button>
  </div>
</header>

<div id="auth-modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center hidden z-50">
  <div class="bg-gray-800 rounded-xl shadow-2xl w-full max-w-md p-6 relative text-gray-100">

    <button id="close-auth-modal"
      class="absolute top-3 right-3 text-gray-400 hover:text-white text-2xl">&times;</button>

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

<section class="bg-[url('https://images.unsplash.com/photo-1503376780353-7e6692767b70')] bg-cover bg-center">
  <div class="bg-black/80">
    <div class="max-w-7xl mx-auto px-6 py-28 text-center">
      <h2 class="text-5xl font-extrabold mb-4 text-white">
        Rent the Perfect Car in Morocco
      </h2>
      <p class="mb-8 text-lg text-gray-300">
        Flexible rentals • Best prices • New vehicles
      </p>
      <a href="#vehicles" class="inline-block bg-yellow-500 text-black font-semibold py-3 px-6 rounded-lg hover:bg-yellow-400 transition">Explore Vehicles</a>
    </div>
  </div>
</section>

<!-- Features Section -->
<section class="max-w-7xl mx-auto px-6 py-16">
  <h3 class="text-3xl font-bold mb-10 text-center text-yellow-400">Why Choose MaBagnole?</h3>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-300">
    <div class="bg-gray-800 rounded-xl p-6 text-center shadow-lg hover:shadow-yellow-500/50 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 h-12 w-12 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6h13v6a2 2 0 01-2 2H9zM4 17V7a2 2 0 012-2h7v4H9v6h11v-6a2 2 0 012-2h-7v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v10z" /></svg>
      <h4 class="text-xl font-semibold mb-2">Wide Vehicle Selection</h4>
      <p>Choose from economy, luxury, SUV, and motorbikes for every need.</p>
    </div>
    <div class="bg-gray-800 rounded-xl p-6 text-center shadow-lg hover:shadow-yellow-500/50 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 h-12 w-12 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8M8 11h5m-2 8h4a2 2 0 002-2v-3a3 3 0 00-3-3h-3v-2a2 2 0 012-2h2" /></svg>
      <h4 class="text-xl font-semibold mb-2">Easy Booking Process</h4>
      <p>Book your vehicle online with a few clicks and instant confirmation.</p>
    </div>
    <div class="bg-gray-800 rounded-xl p-6 text-center shadow-lg hover:shadow-yellow-500/50 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 h-12 w-12 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479L12 14z" /></svg>
      <h4 class="text-xl font-semibold mb-2">Affordable Prices</h4>
      <p>Competitive rates with flexible rental durations to fit your budget.</p>
    </div>
  </div>
</section>

<!-- How It Works -->
<section class="bg-gray-950 py-16 px-6 max-w-7xl mx-auto rounded-xl mb-6">
  <h3 class="text-3xl font-bold mb-10 text-yellow-400 text-center">How It Works</h3>
  <div class="grid md:grid-cols-3 gap-10 text-gray-300">
    <div class="bg-gray-800 rounded-xl p-6 text-center shadow-lg hover:shadow-yellow-500/50 transition">
      <div class="text-yellow-400 mb-4 text-4xl font-bold">1</div>
      <h4 class="text-xl font-semibold mb-2">Browse Vehicles</h4>
      <p>Explore our wide range of vehicles suited to all your travel needs.</p>
    </div>
    <div class="bg-gray-800 rounded-xl p-6 text-center shadow-lg hover:shadow-yellow-500/50 transition">
      <div class="text-yellow-400 mb-4 text-4xl font-bold">2</div>
      <h4 class="text-xl font-semibold mb-2">Book Online</h4>
      <p>Select your preferred dates, and book your car with instant confirmation.</p>
    </div>
    <div class="bg-gray-800 rounded-xl p-6 text-center shadow-lg hover:shadow-yellow-500/50 transition">
      <div class="text-yellow-400 mb-4 text-4xl font-bold">3</div>
      <h4 class="text-xl font-semibold mb-2">Pick Up & Drive</h4>
      <p>Collect your vehicle and enjoy your journey with peace of mind.</p>
    </div>
  </div>
</section>

<!-- articles -->

<section class="max-w-6xl mx-auto p-6 mb-10">
    <h2 class="text-2xl text-yellow-400 text-center font-semibold mb-4">Blog Themes</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        
      <?php
        foreach($data as $da){
          echo "
            <div class='bg-gray-800 p-4 rounded shadow hover:shadow-indigo-600 transition'>
                <h3 class='text-xl font-bold mb-2 text-indigo-400'>{$da['title']}</h3>
                <p class='text-gray-300'>{$da['description']}.</p>
                <a href='./View/theme_articls.php?id={$da['id']}' class='inline-block mt-3 text-indigo-400 hover:underline'>Explore Articles</a>
            </div>
        ";
        }
      ?>
    </div>
    </section>

<!-- Available Vehicles -->
<section id="vehicles" class="bg-gray-950 py-16">
  <h3 class="text-3xl font-bold mb-10 text-center text-yellow-400">Available Vehicles</h3>

  <div class="max-w-md mx-auto mb-10 relative">
    <input id="search" type="text" placeholder="Search vehicles..."
      class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-800 border border-gray-700 focus:ring-2 focus:ring-yellow-500 outline-none" />

    <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"
      fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
    </svg>
  </div>

  <div class="max-w-7xl mx-auto px-6">
    <div id="listvehicles" class="grid grid-cols-1 md:grid-cols-3 gap-8"></div>
  </div>
</section>

<!-- Testimonials -->
<section class="max-w-7xl mx-auto px-6 py-16">
  <h3 class="text-3xl font-bold mb-10 text-center text-yellow-400">What Our Customers Say</h3>
  <div class="grid md:grid-cols-3 gap-8 text-gray-300">
    <div class="bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-yellow-500/50 transition">
      <p class="mb-4 italic">"Great service and friendly staff. The booking was smooth and the car was in excellent condition."</p>
      <p class="font-semibold text-yellow-400">- Sara M.</p>
    </div>
    <div class="bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-yellow-500/50 transition">
      <p class="mb-4 italic">"Affordable prices and a wide selection of vehicles. Highly recommend MaBagnole!"</p>
      <p class="font-semibold text-yellow-400">- Omar K.</p>
    </div>
    <div class="bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-yellow-500/50 transition">
      <p class="mb-4 italic">"The customer support was very helpful, and the whole process was hassle-free."</p>
      <p class="font-semibold text-yellow-400">- Lina A.</p>
    </div>
  </div>
</section>

<footer class="bg-black text-gray-400">
  <div class="max-w-7xl mx-auto px-6 py-8 text-center">
    © 2025 MaBagnole. All rights reserved.
  </div>
</footer>

<script src="./index.js"></script>

</body>
</html>
