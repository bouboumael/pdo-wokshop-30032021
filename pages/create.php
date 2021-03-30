<?php

require_once '../src/DataBase.php';

$data = [];
$errors = [];
$indexNames = ['title', 'content', 'author'];

if (!empty($_POST)) {
    $data = array_map('trim', $_POST);
    foreach ($data as $input => $text) {
        if (!in_array($input, $indexNames)){
            $errors[] = 'Le champ ' . $input . ' n\'existe pas';
        } elseif (empty($data[$input])) {
            $errors[] = 'le champ ' . $input . ' doit être saisi !';
        } elseif (!is_string($text)) {
            $errors[] = 'Le formulaire doit être du texte';
        } else {
            $data[$input] = htmlentities($text);
        }
    }

    if (empty($errors)) {
        $query = new DataBase();
        $query->insert($data['title'], $data['content'], $data['author']);
        header('location: ../index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Pdo workshop</title>
</head>
<body>
    <main>
        <h1>Entrainement à PDO/creation</h1>
        <section>
            <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $message): ?>
                    <li><?= $message ?></li>
                <?php endforeach ?>
            </ul>
            <?php endif ?>
            <form action="" method="POST">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" placeholder="Tomtom et Nana" required>
                <label for="content">Résumé</label>
                <textarea name="content" id="content" cols="30" rows="10" placeholder="Resume ce livre ici!" required></textarea>
                <label for="author">Auteur</label>
                <input type="text" name="author" id="author" placeholder="Jacqueline Cohen" required>
                <button type="submit">Envoyer</button>
            </form>
        </section>
    </main>
</body>
</html>