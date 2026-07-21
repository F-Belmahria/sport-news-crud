<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['LOGGED_USER'])) {
    header('Location: /sport-news-crud/index.php?page=login');
    exit;
}

require_once __DIR__ . '/../../config/database.php';

if (
    !isset($_POST['id']) ||
    !is_numeric($_POST['id'])
) {
    echo "Il faut un identifiant valide pour supprimer un article.";
    exit;
}

$id = (int) $_POST['id'];

$sql = "DELETE FROM articles WHERE id = :id";

$deleteArticleStatement = $pdo->prepare($sql);

$deleteArticleStatement->execute([
    'id' => $id
]);
// Message enregistré dans la session
$_SESSION['DELETE_SUCCESS_MESSAGE'] =
    "L'article a été supprimé avec succès.";
header('Location: /sport-news-crud/index.php?page=articles');
exit;