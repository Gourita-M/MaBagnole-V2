<?php

include_once "../controlls/addArticles_logic.php"; 

?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <title>Add New Article - MaBagnole Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">

<?php include_once "./header.php"; ?>
    <h2 class="text-2xl mt-10 text-center font-semibold mb-6 text-blue-400"> Theme : <span class="text-blue-300"><?= htmlspecialchars($theme[0]['title']) ?></span></h2>
<main class="max-w-3xl mx-auto p-6 bg-gray-800 rounded shadow mt-6">

    <form method="POST" class="space-y-5">

        <div>
            <label for="title" class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" required
                   class="w-full border border-gray-700 rounded px-3 py-2 bg-gray-900 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="content" class="block font-semibold mb-1">Content</label>
            <textarea id="content" name="content" rows="8" required
                      class="w-full border border-gray-700 rounded px-3 py-2 bg-gray-900 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
        </div>

        <div class="flex flex-wrap gap-2">

        <?php foreach($tagsnames as $tagss): ?>
            <label class="cursor-pointer">
                <input type="checkbox" name="tags[]" value="<?= htmlspecialchars($tagss['id']) ?>" class="peer hidden">
                <span class="px-3 py-1 rounded-full border border-gray-600 text-gray-300
                            peer-checked:bg-blue-600 peer-checked:border-blue-600 peer-checked:text-white">
                <?= htmlspecialchars($tagss['name']) ?>
                </span>
            </label>
        <?php endforeach; ?>
        </div>


        <div>
            <label for="media" class="block font-semibold mb-1">Media ( Video/Image URL )</label>
            <input type="text" id="media" name="media"
                   class="w-full border border-gray-700 rounded px-3 py-2 bg-gray-900 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <button name="addarticle" type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700">Submit Article</button>
    </form>

</main>

<footer class="bg-black text-gray-400 p-4 text-center mt-8">
    &copy; 2026 MaBagnole. All rights reserved.
</footer>

</body>
</html>
