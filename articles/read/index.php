<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../config/database.php';

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
        matches.lieu
    FROM articles
    JOIN matches
    ON articles.match_id = matches.id
    ORDER BY articles.date_publication DESC
";

$requete = $pdo->query($sql);
$articles = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Articles sportifs</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Mon CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
     <?php
   if (isset($_SESSION['LOGGED_USER']) && !isset($_SESSION['MODAL_SHOWN'])) :
     $_SESSION['MODAL_SHOWN'] = true;
        ?>
         <!-- Modale Bootstrap (popup) -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- En-tête de la modale -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                           Bonjour <?= htmlspecialchars($_SESSION['LOGGED_USER']['prenom']) ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Corps de la modale -->
                    <div class="modal-body">
                        Bienvenue sur le site de l'équipe ! <br>
                        Vous avez à présent accès aux articles et résultats sportifs.
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.show();
    });
</script>
<?php endif; ?>
    <main class="container my-5">

        <div class="text-center mb-4">
            <a href="../create/create.php" class="btn btn-outline-primary">
                Ajouter un nouvel article
            </a>
        </div>

        <div class="row g-4">

            <?php foreach ($articles as $article) : ?>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm">

                        <img 
                            src="/sport-news-crud/assets/images/<?= htmlspecialchars($article['image']) ?>" 
                            class="card-img-top" 
                            alt="Image de l'article"
                        >

                        <div class="card-body">

                            <span class="badge bg-light text-dark mb-2">
                                <?= htmlspecialchars($article['date_publication']) ?>
                            </span>

                            <h5 class="card-title">
                                <?= htmlspecialchars($article['titre']) ?>
                            </h5>

                            <p class="text-danger fw-bold mb-1">
                                Score : <?= htmlspecialchars($article['score']) ?>
                            </p>

                            <p class="text-muted mb-2">
                                à <?= htmlspecialchars($article['lieu']) ?>
                            </p>

                            <p class="card-text">
                                <?= htmlspecialchars(substr($article['contenu'], 0, 100)) ?>...
                            </p>

                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">

                            <a href="/sport-news-crud/article/<?= $article['article_id'] ?>.html" class="btn btn-primary btn-sm">
    Voir l'article
</a>

                            <div>
                                <a href="../update/edit.php?id=<?= $article['article_id'] ?>" class="btn btn-light btn-sm">
                                     <i class="fa-solid fa-pen"></i>
                                </a>

                                <a 
                                    href="../delete/delete.php?id=<?= $article['article_id'] ?>" 
                                    class="btn btn-light btn-sm"
                                    
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    </main>

</body>
</html>