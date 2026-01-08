<?php 
session_start();
    include_once "../controlls/theme_logic.php";
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Articles by Theme - MaBagnole Blog (Dark Mode)</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body, a, h1, h2, h3, p, span, nav {
      transition: color 0.3s ease, background-color 0.3s ease;
    }
  </style>
</head>
<body class="bg-gray-900 text-gray-200 min-h-screen">

  <?php include_once "./header.php"; ?>

  <main class="container mx-auto px-4 py-10">
    <h2 class="text-2xl font-semibold mb-6 text-blue-400">Articles on Theme: <span class="text-blue-300"><?= $daata[0]['title'] ?></span></h2>
    
    <div class="mb-8 flex justify-end">
      <a href="./addArtcle.php?theme_id=<?= $daata[0]['theme_id'] ?>"
        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">

        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4v16m8-8H4" />
        </svg>

        Add Article
      </a>
    </div>

    <div class="space-y-6">

       <?php 
       foreach($daata as $a){
       echo "
        <article class='bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-blue-500/50 transition-shadow'>
            <h3 class='text-xl font-semibold text-gray-100 hover:text-blue-400 cursor-pointer'>
            <a href='./article.php?id={$a['id']}'>{$a['title_art']}</a>
            </h3>
            <p class='mt-2 text-gray-300'>
            {$a['content']}.
            </p>
            <div class='mt-3 text-sm text-gray-500'>
            <span>Published on {$a['publish_date']}, 2026</span>
            </div>
        </article>
        ";
       }
      ?>
      
    </div>

    <!-- Pagination -->
    <nav class="mt-10 flex justify-center items-center space-x-3" aria-label="Pagination">
      <a href="#" class="px-3 py-1 bg-gray-700 rounded hover:bg-blue-600 hover:text-white" aria-label="Previous page">Previous</a>
      <a href="#" class="px-3 py-1 bg-blue-600 text-white rounded">1</a>
      <a href="#" class="px-3 py-1 bg-gray-700 rounded hover:bg-blue-600 hover:text-white">2</a>
      <a href="#" class="px-3 py-1 bg-gray-700 rounded hover:bg-blue-600 hover:text-white">3</a>
      <a href="#" class="px-3 py-1 bg-gray-700 rounded hover:bg-blue-600 hover:text-white" aria-label="Next page">Next</a>
    </nav>
  </main>

  <footer class="bg-gray-800 mt-20 py-6 shadow-inner">
    <div class="container mx-auto px-4 text-center text-gray-500 text-sm">
      &copy; 2026 MaBagnole. All rights reserved.
    </div>
  </footer>

</body>
</html>
