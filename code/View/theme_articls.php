<?php 
session_start();
include_once "../controlls/theme_logic.php";

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Articles by Theme - MaBagnole Blog</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

  <style>
    body, a, h1, h2, h3, p, span {
      transition: all 0.3s ease;
    }
    table.dataTable thead th {
      color: #93c5fd;
      background-color: #1f2937;
    }
    table.dataTable tbody td {
      background-color: #111827;
      color: #e5e7eb;
    }
  </style>
</head>

<body class="bg-gray-900 text-gray-200 min-h-screen">

<?php include_once "./header.php"; ?>

<main class="container mx-auto px-4 py-10">

  <h2 class="text-2xl font-semibold mb-6 text-blue-400">
    Articles on Theme:
    <span class="text-blue-300"><?= htmlspecialchars($daata[0]['title']) ?></span>
  </h2>

  <div class="mb-6 flex justify-end">
    <a href="./addArtcle.php?theme_id=<?= $daata[0]['id'] ?>"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
       + Add Article
    </a>
  </div>

  <!-- Filter -->
<div class="mb-6 flex items-center gap-4">
  <label for="tagFilter" class="text-gray-300 font-medium">
    Filter by tag:
  </label>
  <select id="tagFilter"
          class="bg-gray-800 text-white px-4 py-2 rounded-lg border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
    <option value="">All Tags</option>
    <?php foreach($alltags as $tag): ?>
      <option value="<?= $tag['name'] ?>">
        <?= htmlspecialchars($tag['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<!-- Articles Table -->
<div class="overflow-x-auto rounded-lg shadow-lg">
  <table id="articlesTable" class="w-full text-sm text-left text-gray-300">
    <thead class="bg-gray-800 text-gray-400 uppercase text-xs">
      <tr>
        <th class="px-6 py-4">Title</th>
        <th class="px-6 py-4">Content</th>
        <th class="px-6 py-4">Tags</th>
        <th class="px-6 py-4">Published</th>
      </tr>
    </thead>
    <tbody class="bg-gray-900 divide-y divide-gray-800">

      <?php foreach ($daata as $a): ?>
        <tr class="hover:bg-gray-800 transition">
          <td class="px-6 py-4 font-semibold">
            <a href="./article.php?id=<?= $a['id'] ?>"
               class="text-blue-400 hover:text-blue-300 hover:underline">
              <?= htmlspecialchars($a['title_art']) ?>
            </a>
          </td>

          <td class="px-6 py-4 text-gray-400">
            <?= htmlspecialchars(substr($a['content'], 0, 120)) ?>…
          </td>

          <td class="px-6 py-4">
            <span class="inline-block bg-blue-900/40 text-blue-300 px-3 py-1 rounded-full text-xs font-medium">
              <?= htmlspecialchars($a['tags']) ?>
            </span>
          </td>

          <td class="px-6 py-4 text-gray-400">
            <?= htmlspecialchars($a['publish_date']) ?>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>

</main>

<!-- Footer -->
<footer class="bg-gray-900 mt-20 py-6 border-t border-gray-800">
  <div class="text-center text-gray-500 text-sm">
    &copy; 2026 MaBagnole. All rights reserved.
  </div>
</footer>

<!-- DataTables Script -->
<script>
$(document).ready(function () {
    const table = $('#articlesTable').DataTable({
        paging: true,
        searching: true,
        info: false,
        lengthChange: false,
        pageLength: 6,
        order: [[3, 'desc']],
        language: {
            search: "",
            searchPlaceholder: "Search articles..."
        },
        dom: '<"flex justify-between items-center mb-4"f>rt<"flex justify-between items-center mt-4"p>'
    });

    $('#tagFilter').on('change', function () {
        table.column(2).search(this.value).draw();
    });
});
</script>


</body>
</html>
