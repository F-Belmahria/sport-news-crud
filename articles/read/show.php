<?php


require_once '../../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

$sql = "
    SELECT 
        articles.id AS article_id,
        articles.titre,
        articles.contenu,
        articles.auteur,
        articles.image,
        articles.date_publication,
        matches.equipe1,
        matches.equipe2,
        matches.score,
        matches.lieu,
        matches.date_match,
        matches.resume
    FROM articles
    JOIN matches
    ON articles.match_id = matches.id
    WHERE articles.id = :id
";

$requete = $pdo->prepare($sql);
$requete->execute([
    'id' => $id
]);

$article = $requete->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo "Article introuvable.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($article['titre']) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">
   <?php require_once '../../includes/header.php'; ?>


<main class="container my-5 flex-grow-1">

    <a href="/sport-news-crud/articles/read/index.php"class="btn btn-outline-secondary mb-4">
        Retour aux articles
    </a>

    <div class="card shadow-sm border-0">
<?php
$image = 'default.png';

if (!empty($article['image']) && file_exists(__DIR__ . '/../../assets/images/' . $article['image'])) {
    $image = $article['image'];
}
?>

<img 
    src="/sport-news-crud/assets/images/<?= htmlspecialchars($image) ?>" 
    class="card-img-top" 
    alt="Image de l'article"
>
        <div class="card-body">

            <span class="badge bg-light text-dark mb-3">
                <?= htmlspecialchars($article['date_publication']) ?>
            </span>

            <h1 class="mb-3">
                <?= htmlspecialchars($article['titre']) ?>
            </h1>

            <p class="text-muted">
                Par <?= htmlspecialchars($article['auteur']) ?>
            </p>

            <hr>

            <h5>Match concerné</h5>

            <p>
                <?= htmlspecialchars($article['equipe1']) ?>
                contre
                <?= htmlspecialchars($article['equipe2']) ?>
            </p>

            <p class="text-danger fw-bold">
                Score : <?= htmlspecialchars($article['score']) ?>
            </p>

            <p>
                Lieu : <?= htmlspecialchars($article['lieu']) ?>
            </p>

            <p>
                Date du match : <?= htmlspecialchars($article['date_match']) ?>
            </p>

            <hr>

            <p>
                <?= nl2br(htmlspecialchars($article['contenu'])) ?>
            </p>

        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-between">

            <a href="/sport-news-crud/articles/update/edit.php?id=<?= $article['article_id'] ?>" class="btn btn-primary">
                Modifier
            </a>

            <a 
                href="/sport-news-crud/articles/delete/delete.php?id=<?= $article['article_id'] ?>" 
                class="btn btn-danger"
              
            >
                Supprimer
            </a>

        </div>

    </div>

</main>
<?php require_once '../../includes/footer.php'; ?>
</body>
</html>