<?php
// Sprawdzenie, czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie treści posta i oczyszczenie danych wejściowych
    $content = htmlspecialchars($_POST['content']);
    if (!empty($content)) {
        // Dodanie posta do pliku tekstowego
        file_put_contents('posts.txt', $content . PHP_EOL, FILE_APPEND);
    }
}

// Odczytanie postów z pliku tekstowego
$posts = file_exists('posts.txt') ? file('posts.txt') : [];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proste Forum</title>
    <style>
        /* Podstawowy CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            padding: 10px;
            background: #fff;
            border: 1px solid #ccc;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            color: #444;
        }

        form {
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background: #007bff;
            color: #fff;
            border: 1px solid #0056b3;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .post {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .post:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Proste Forum</h1>
        <form method="POST">
            <textarea name="content" placeholder="Napisz coś..." required></textarea>
            <br>
            <button type="submit">Dodaj post</button>
        </form>
        <div>
            <h2>Posty:</h2>
            <?php if (empty($posts)): ?>
                <p>Brak postów. Bądź pierwszy!</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post"><?= nl2br($post) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>