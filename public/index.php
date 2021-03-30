<?php

require_once '../src/DataBase.php';

$database = new DataBase;
$libraries = $database->selectAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Ma librairie</title>
</head>
<body>
    <?php foreach ($libraries as $book): ?>
    <section>
        <h2>Title : <?= ucfirst($book->title) ?></h2>
        <h3>Author: <?= ucfirst($book->author) ?></h3>
        <p><?= $book->content ?></p>
        <button><a href="pages/edit.php?id=<?= $book->id ?>">Edit</a></button>
    </section>
    <br>
    <?php endforeach ?>
    <br>
    <button><a href="pages/create.php">New Book</a></button> 
</body>
</html>