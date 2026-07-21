<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/database.php';
if (!isset($_GET['id'])) {
    header('Location: /sport-news-crud/index.php?page=articles');
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



<main class="container my-5 flex-grow-1">

    <a href="/sport-news-crud/index.php?page=articles"
    class="btn btn-outline-secondary mb-4">
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
<?php if (isAdmin()) : ?>

    <div class="card-footer bg-white border-0 d-flex justify-content-between">

        <a
            href="/sport-news-crud/index.php?page=edit&id=<?= (int) $article['article_id'] ?>"
            class="btn btn-primary"
        >
            Modifier
        </a>

        <a
            href="/sport-news-crud/index.php?page=delete&id=<?= (int) $article['article_id'] ?>"
            class="btn btn-danger"
        >
            Supprimer
        </a>

    </div>

<?php endif; ?>
    </div>

</main>
