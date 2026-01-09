<?php

    include_once "../controlls/Comments_logic.php";

?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <title>Article Title - MaBagnole Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">

<?php include_once "./header.php"; ?>

<main class="max-w-4xl mx-auto p-6 bg-gray-800 rounded shadow mt-6">

    <section class="mb-6">
        <p class="text-gray-300 leading-relaxed">
            <?= htmlspecialchars($datao[0]['title_art']); ?>
        </p>
        <p class="text-sm text-gray-500 mt-3">Published on 2026-01-01 by Alice Martin</p>

        <!-- Tags -->
        <div class="mt-4">
            <?php foreach($tagsnames as $names): ?>
            <span class="inline-block bg-indigo-600 text-white px-3 py-1 rounded-full text-sm font-semibold mr-2"><?= htmlspecialchars($names['name']) ?></span>
            <?php endforeach; ?>
        </div>

        <!-- Media -->
        <div class="mt-6">
            <img src="<?= htmlspecialchars($datao[0]['art_media']); ?>" alt="Oil Change" class="rounded shadow max-w-full" />
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-bold mb-4">Comments</h2>

    <?php foreach($commdata as $comm): ?>
        <?php if($comm['deleted'] != '1' ): ?>
            <div class="border-b border-gray-700 py-3 flex justify-between items-start">
                <div>
                    <p class="text-gray-300">
                        <?= htmlspecialchars($comm['content']) ?>
                    </p>
                    <p class="text-sm text-gray-500">
                        By <?= htmlspecialchars($comm['user_name']) ?>
                        on <?= htmlspecialchars($comm['creation_date']) ?>
                    </p>
                </div>
            <?php if($comm['user_id'] == $_SESSION['userid']): ?>
                <div class="flex gap-2">

                    <a href="edit_comment.php?id=<?= $comm['id'] ?>"
                    class="text-blue-400 text-sm hover:text-blue-300">
                        Edit
                    </a>

                    <a href="delete_comment.php?id=<?= $comm['id'] ?>"
                    class="text-red-400 text-sm hover:text-red-300">
                        Delete
                    </a>

                </div>
            <?php endif; ?>
            </div>
        <?php endif; ?>        
    <?php endforeach; ?>
        <p class="text-center text-red-500"><?= $errormessage ?></p>
        <form class="mt-6" method="POST">
            <label for="comment" class="block mb-2 font-semibold">Add a Comment</label>
            <textarea id="comment" name="content" rows="4" class="w-full border border-gray-700 rounded px-3 py-2 bg-gray-900 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            <button name="comment" type="submit" class="mt-3 bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700">Submit Comment</button>
        </form>
    </section>

</main>

<footer class="bg-black text-gray-400 p-4 text-center mt-8">
    &copy; 2026 MaBagnole. All rights reserved.
</footer>

</body>
</html>
