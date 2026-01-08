<?php 
  session_start();
  include_once "../controlls/Reservation_logic.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rent a Car | MaBagnole</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen">

<?php include_once "./header.php"; ?>

<main class="max-w-6xl mx-auto px-6 py-10">

  <h2 class="text-4xl font-bold text-yellow-400 mb-8">
    Rent This Vehicle
  </h2>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <section class="lg:col-span-2 bg-gray-800 p-6 rounded-xl shadow">

      <h3 class="text-2xl font-semibold mb-6">Reservation Details</h3>

      <form method="POST" class="space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm mb-1">Pick-up Date</label>
            <input name="pickup" id="pick" type="date"
              class="w-full bg-gray-700 border border-gray-600 rounded px-3 py-2 focus:ring-yellow-500 focus:ring-1 outline-none">
          </div>

          <div>
            <label class="block text-sm mb-1">Return Date</label>
            <input name="back" id="returning" type="date"
              class="w-full bg-gray-700 border border-gray-600 rounded px-3 py-2 focus:ring-yellow-500 focus:ring-1 outline-none">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
          <div>
            <label class="block text-sm mb-1">Pick-up Location</label>
            <select name="picklocation" class="w-full bg-gray-700 border border-gray-600 rounded px-3 py-2">
              <option>Casablanca</option>
              <option>Rabat</option>
              <option>Marrakech</option>
              <option>Tangier</option>
              <option>Fes</option>
              <option>Agadir</option>
              <option>Meknes</option>
              <option>Oujda</option>
              <option>Kenitra</option>
              <option>Safí</option>

            </select>
          </div>
        </div>

        <button name="reserve"
          class="w-full bg-yellow-500 text-black py-3 rounded-xl font-semibold hover:bg-yellow-400 transition">
          Confirm Reservation
        </button>

      </form>
    </section>

    <aside class="bg-gray-800 p-6 rounded-xl shadow">

      <h3 class="text-xl font-semibold mb-4">Vehicle Summary</h3>

      <img
        src="<?= $datavehicle['Vehicle_image'] ?>"
        class="rounded-lg mb-4"
        alt="Car">

      <h4 class="text-lg font-bold text-yellow-400">
        <?= $datavehicle['model'] ?>
      </h4>

      <div class="border-t border-gray-700 pt-4 space-y-2 text-sm">
        <div class="flex justify-between">
          <span>Price / day</span>
          <div>
            <span class="prix text-yellow-400"><?= $datavehicle['price_day'] ?></span>
            <span class="text-yellow-400">DH</span>
          </div>
          
        </div>

        <div class="flex justify-between">
          <span>Estimated days</span>
          <span id="days">0</span>
        </div>

        <div class="flex justify-between font-semibold border-t border-gray-700 pt-2">
          <span>Total</span>
          <span class="total text-yellow-400">0 DH</span>
        </div>
      </div>

    </aside>

  </div>

</main>

<footer class="bg-gray-800 text-gray-400 py-6 text-center mt-16">
  © 2025 MaBagnole — All rights reserved
</footer>

<script>
const pick = document.getElementById('pick');
const returning = document.getElementById('returning');
const days = document.getElementById('days');
const total = document.querySelector('.total');
const prix = document.querySelector('.prix');

returning.addEventListener('input', () => {
  
  const pickDate = new Date(pick.value);
  const returnDate = new Date(returning.value);

  if (pick.value && returning.value) {

    const diffTime = returnDate - pickDate;


    const diffDays = diffTime / (1000 * 60 * 60 * 24);

    days.textContent = diffDays;
    total.textContent = prix.textContent * diffDays;

    if (diffDays < 0) {
      console.log("Return date can't be before pick date");
    }
  }
});
</script>
</body>
</html>
