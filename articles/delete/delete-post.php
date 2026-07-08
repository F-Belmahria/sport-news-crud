<?php

require_once '../../config/database.php';
$postData = $_POST;
if (!isset($postData['id']) || !is_numeric($postData['id'])) {
    echo "Il faut un identifiant valide pour supprimer un article.";
    exit;}
    $id = (int) $postData['id'];
$sql = "DELETE FROM articles WHERE id = :id";
$deleteArticleStatement = $pdo->prepare($sql);
$deleteArticleStatement->execute(['id' => $id]);
header('Location: ../read/index.php');
exit;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Article supprimé</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<main class="container my-5">

    <div class="alert alert-success">
        L'article a été supprimé avec succès.
    </div>

    <a class="btn btn-primary" href="../read/index.php">
        Retour à la liste des articles
    </a>

</main>

</body>
</html>