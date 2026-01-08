<?php 
    session_start();
    include_once "../controlls/vehicles_logic.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Car Details | MaBagnole</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen">

<?php include_once "./header.php"; ?>

<!-- MAIN -->
<main class="max-w-7xl mx-auto px-6 py-10">

  <!-- BACK -->
  <a href="../index.php"
     class="inline-block mb-6 text-sm text-yellow-400 hover:underline">
    ← Back to vehicles
  </a>

  <!-- CAR INFO -->
  <section class="grid grid-cols-1 lg:grid-cols-2 gap-10">

    <!-- IMAGE -->
    <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg">
      <img
        src="<?= $data[0]['Vehicle_image'] ?>"
        class="w-full h-96 object-cover"
        alt="Car Image"
      />
    </div>

    <!-- DETAILS -->
    <div class="flex flex-col justify-between">

      <div>
        <h2 class="text-4xl font-bold text-yellow-400 mb-2">
          <?= $data[0]['model'] ?>
        </h2>

        <br>
        <div class="mb-6">
          <span class="text-3xl font-bold text-yellow-400">
            <?= $data[0]['price_day'] ?> DH
          </span>
          <span class="text-gray-400"> / day</span>
        </div>

        <!-- STATUS -->
        <span class="inline-block mb-6 px-4 py-1 rounded-full text-sm font-semibold
                     bg-green-500/20 text-green-400">
          <?= $data[0]['vehicle_status'] ?>
        </span>

        <!-- DESCRIPTION -->
        <p class="text-gray-300 leading-relaxed mb-6">
          The Dacia Logan is a reliable and economical car, perfect for city driving
          and long trips. Comfortable, fuel-efficient, and easy to handle.
        </p>

      </div>

      <div>
        <?php 
        if(isset($_SESSION['role'])){
          echo "
          <a href='./rent.php?id={$_GET['id']}'
            class='block w-full text-center bg-yellow-500 text-black py-3 rounded-xl font-semibold hover:bg-yellow-400 transition'>
            Rent This Car
        </a>
          ";
        }else{
          echo "
        <button
        class='open-login-modal block w-full text-center bg-yellow-500 text-black py-3 rounded-xl font-semibold hover:bg-yellow-400 transition'>
            Rent This Car
        </button> 
         ";
        }
        ?>
      </div>

    </div>
  </section>

  <!-- REVIEWS -->
  <section class="mt-14">
    <h3 class="text-3xl font-bold mb-6 text-yellow-400">
      Customer Reviews
    </h3>

    <div class="space-y-4">

    <?php 
        foreach($data as $da){
            echo "
                <div class='bg-gray-800 p-4 rounded-lg shadow'>
                    <p class='font-semibold text-yellow-400'>{$da['user_name']}</p>
                    <p class='text-yellow-400'>⭐⭐⭐⭐☆</p>
                    <p class='text-gray-300 mt-1'>
                        '{$da['reviews_comment']}'
                    </p>
                </div>
            ";
        }
    ?>

    </div>
  </section>

</main>

<!-- FOOTER -->
<footer class="bg-gray-800 text-gray-400 py-6 text-center mt-16">
  © 2025 MaBagnole. All rights reserved.
</footer>

<script>
      const authModal = document.getElementById('auth-modal');
    const openLoginBtn = document.querySelector('.open-login-modal');
    const closeAuthBtn = document.getElementById('close-auth-modal');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const showRegisterBtn = document.getElementById('show-register');
    const showLoginBtn = document.getElementById('show-login');

openLoginBtn.addEventListener('click', e => {
    loginForm.classList.remove('hidden');
    registerForm.classList.add('hidden');
    authModal.classList.remove('hidden');
  });

closeAuthBtn.addEventListener('click', () => {
    authModal.classList.add('hidden');
  });

showRegisterBtn.addEventListener('click', () => {
    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');
  });

showLoginBtn.addEventListener('click', () => {
    registerForm.classList.add('hidden');
    loginForm.classList.remove('hidden');
  });

</script>
</body>
</html>
