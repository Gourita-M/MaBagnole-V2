<?php
session_start();
include_once "../controlls/admin_logic.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard | MaBagnole</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<?php include_once "./header.php"; ?>

<div class="bg-gray-900 text-gray-100 min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-64 bg-gray-800 p-6 hidden md:block">
  <nav class="space-y-3">
    <button onclick="showSection('stats')" class="nav-btn">📊 Dashboard</button>
    <button onclick="showSection('vehicles')" class="nav-btn">🚗 Vehicles</button>
    <button onclick="showSection('categories')" class="nav-btn">📂 Categories</button>
    <button onclick="showSection('reservations')" class="nav-btn">📅 Reservations</button>
    <button onclick="showSection('reviews')" class="nav-btn">⭐ Reviews</button>
    <button onclick="showSection('articles')" class="nav-btn">📰 Articles</button>
    <button onclick="showSection('themes')" class="nav-btn">🎨 Themes</button>
    <button onclick="showSection('comments')" class="nav-btn">💬 Comments</button>
  </nav>
</aside>

<main class="flex-1 p-8">

<section id="stats" class="admin-section">
  <h2 class="title">Statistics Overview</h2>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="stat-card">🚗 Vehicles <span>32</span></div>
    <div class="stat-card">📅 Reservations <span>74</span></div>
    <div class="stat-card">⭐ Reviews <span>189</span></div>
  </div>
</section>

<section id="vehicles" class="admin-section hidden">
  <h2 class="title">Vehicle Management</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Model</th>
        <th>Price/Day</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($vehicledata as $v): ?>
      <tr>
        <td><?= htmlspecialchars($v['model']) ?></td>
        <td><?= htmlspecialchars($v['price_day']) ?></td>
        <td class="text-green-400"><?= htmlspecialchars($v['vehicle_status']) ?></td>
        <td class="space-x-2">
          <a href="./edit_Vehicle.php?vehicleid=<?= htmlspecialchars($v['vehicle_id']) ?>" class="btn-edit">Edit</a>
          <a href="./delete_Vehicle.php?vehicleid=<?= htmlspecialchars($v['vehicle_id']) ?>" class="btn-delete">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>

<section id="categories" class="admin-section hidden">
  <h2 class="title">Category Management</h2>
  <table class="table">
    <thead>
      <tr><th>ID</th><th>Name</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php foreach($categorydata as $c): ?>
      <tr>
        <td><?= $c['id'] ?></td>
        <td><?= htmlspecialchars($c['cate_name']) ?></td>
        <td><button class="btn-delete">Delete</button></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>

<section id="reservations" class="admin-section hidden">
  <h2 class="title">Reservations</h2>
  <?php foreach($reserdata as $r): ?>
  <div class="card">
    <div>
      <p class="font-semibold"><?= htmlspecialchars($r['model']) ?></p>
      <p class="text-sm text-gray-400"><?= $r['start_date'] ?> → <?= $r['end_date'] ?></p>
    </div>
    <div class="space-x-2">
      <button class="btn-approve">Approve</button>
      <button class="btn-reject">Reject</button>
    </div>
  </div>
  <?php endforeach; ?>
</section>

<section id="reviews" class="admin-section hidden">
  <h2 class="title">Reviews</h2>
  <?php foreach($revidate as $rev): if($rev['reviews_comment']): ?>
  <div class="card">
    <div>
      <p class="font-semibold"><?= htmlspecialchars($rev['model']) ?></p>
      <p class="text-sm text-gray-400">"<?= htmlspecialchars($rev['reviews_comment']) ?>"</p>
    </div>
    <a href="./delete_review.php?id=<?= $rev['reviews_id'] ?>" class="btn-delete">Delete</a>
  </div>
  <?php endif; endforeach; ?>
</section>

<section id="articles" class="admin-section hidden">
  <h2 class="title">Articles Management</h2>
  <div class="bg-gray-800 p-6 rounded-lg mb-6">
    <input type="text" placeholder="Article title" class="input">
    <select class="input">
      <option>Select Theme</option>
    </select>
    <textarea class="input h-32" placeholder="Article content"></textarea>
    <button class="btn-primary">Publish Article</button>
  </div>
</section>

<section id="themes" class="admin-section hidden">

  <h2 class="title mb-4 text-2xl font-bold text-gray-800">Themes Management</h2>

  <form method="POST" id="add-theme-form" class="mb-8 space-y-4">
    <input 
      type="text" 
      name="theme_name" 
      placeholder="Theme name" 
      class="input block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
      required
    >
    <textarea 
      name="description"
      placeholder="Theme Description"
      rows="5"
      class="input block w-full border border-gray-300 rounded px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
      required
    ></textarea>
    <button 
      name="addtheme"
      type="submit" 
      class="btn-primary bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded"
    >
      Add Theme
    </button>
  </form>

  <div id="existing-themes" class="space-y-4">
    <?php foreach($listthemes as $them): ?>
    <div class="theme-item p-4 border border-gray-300 rounded flex flex-col md:flex-row md:items-center md:justify-between gap-4">
      <div>
        <h3 class="font-semibold text-lg text-white-900"><?= htmlspecialchars($them['title']) ?></h3>
        <p class="text-white-600"><?= htmlspecialchars($them['description']) ?></p>
      </div>
      <div class="flex gap-2">
        <a href="./edit_Theme.php?themeid=<?= htmlspecialchars($them['id']) ?>" class="edit-btn bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded font-medium">Edit</a>
        <a href="./delete_Theme.php?themeid=<?= htmlspecialchars($them['id']) ?>" class="delete-btn bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded font-medium">Delete</a>
      </div>
    </div>
    <?php endforeach; ?>
</section>

<section id="comments" class="admin-section hidden">
  <h2 class="title">Comments Moderation</h2>
  <?php foreach($commentsdata as $commen): ?>
  <div class="card">
    <p><?= htmlspecialchars($commen['content']) ?></p>
    <div class="flex gap-5 justify-center items-center">
      <?php if($commen['deleted'] === 1 ): ?>
        <p class="text-yellow-200">Deleted</p>
      <?php endif; ?>
    <form method="POST">
      <input type="hidden" name="commentid" value="<?= htmlspecialchars($commen['id']) ?>">
      <button name="deletecomment" type="submit" class="btn-delete">Remove</button>
    </form>
    </div>
  </div>
  <?php endforeach; ?>
</section>

</main>
</div>

<!-- JS -->
<script>
function showSection(id) {
  document.querySelectorAll('.admin-section').forEach(s => s.classList.add('hidden'));
  document.getElementById(id).classList.remove('hidden');
}
</script>

<!-- STYLES -->
<style>
.nav-btn{width:100%;text-align:left;padding:10px;background:#374151;border-radius:8px}
.nav-btn:hover{background:#facc15;color:black}
.title{font-size:28px;font-weight:bold;color:#facc15;margin-bottom:20px}
.stat-card{background:#1f2937;padding:20px;border-radius:12px;display:flex;justify-content:space-between}
.table{width:100%;background:#1f2937;border-radius:10px}
.table th,.table td{padding:12px;border-bottom:1px solid #374151}
.card{background:#1f2937;padding:16px;border-radius:10px;display:flex;justify-content:space-between;margin-bottom:12px}
.input{width:100%;background:#374151;padding:10px;border-radius:8px;margin-bottom:12px}
.btn-primary{background:#facc15;color:black;padding:8px 16px;border-radius:8px}
.btn-edit{background:#22c55e;padding:4px 10px;border-radius:6px}
.btn-delete{background:#ef4444;padding:4px 10px;border-radius:6px}
.btn-approve{background:#22c55e;padding:6px 12px;border-radius:6px}
.btn-reject{background:#ef4444;padding:6px 12px;border-radius:6px}
</style>

</body>
</html>
