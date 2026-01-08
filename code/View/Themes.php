<?php 
session_start();
     include_once "../controlls/home_themes.php";

?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <title>Articles by Theme - MaBagnole Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">

<?php include_once "./header.php"; ?>

<main class="max-w-5xl mx-auto p-6">
    <div class="space-y-4">
        <?php 
        foreach($data as $sa){
            echo "
        <article class='bg-gray-800 p-4 rounded shadow hover:shadow-indigo-600 transition cursor-pointer'>
            <h2 class='text-xl font-semibold text-indigo-400 hover:underline'>
                <a href='./theme_articls.php?id={$sa['id']}'>{$sa['title']}</a>
            </h2>
            <p class='text-gray-300 mt-2'>Step by step guide to changing oil at home...</p>
            <p class='text-sm text-gray-500 mt-1'>Published on 2026-01-01</p>
        </article>
        ";
        }
        ?>
    </div>

    <!-- Pagination -->
    <nav class="mt-6 flex justify-center space-x-3">
        <a href="#" class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">1</a>
        <a href="#" class="px-3 py-1 bg-gray-700 rounded hover:bg-gray-600">2</a>
        <a href="#" class="px-3 py-1 bg-gray-700 rounded hover:bg-gray-600">3</a>
    </nav>
</main>

<footer class="bg-black text-gray-400 p-4 text-center mt-8">
    &copy; 2026 MaBagnole. All rights reserved.
</footer>

</body>
</html>
