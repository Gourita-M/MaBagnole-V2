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

  <div class="mb-6 flex gap-4">
    <select id="tagFilter"
            class="bg-gray-800 text-white px-4 py-2 rounded">
      <option value="">All Tags</option>
      <?php foreach($alltags as $tag): ?>
      <option value="<?= $tag['name'] ?>"><?= $tag['name'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <table id="articlesTable" class="display w-full rounded overflow-hidden">
    <thead>
      <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Tags</th>
        <th>Published</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($daata as $a): ?>
        <tr>
          <td class="font-semibold">
            <a href="./article.php?id=<?= $a['id'] ?>"
               class="text-blue-400 hover:underline">
              <?= htmlspecialchars($a['title_art']) ?>
            </a>
          </td>

          <td>
            <?= htmlspecialchars(substr($a['content'], 0, 120)) ?>...
          </td>

          <td>
            <span class="bg-blue-900 text-blue-300 px-2 py-1 rounded text-sm">
              <?= htmlspecialchars($a['tags']) ?>
            </span>
          </td>

          <td>
            <?= htmlspecialchars($a['publish_date']) ?>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>

</main>

<footer class="bg-gray-800 mt-20 py-6 shadow-inner">
  <div class="text-center text-gray-500 text-sm">
    &copy; 2026 MaBagnole. All rights reserved.
  </div>
</footer>

<script>
$(document).ready(function () {
    const table = $('#articlesTable').DataTable({
        paging: true,
        searching: true,
        info: false,
        lengthChange: false,
        language: {
            search: "Search article:"
        }
    });

    $('#tagFilter').on('change', function () {
        table.column(2).search(this.value).draw();
    });
});
</script>

</body>
</html>
