<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['LOGGED_USER'])) {
    header('Location: /sport-news-crud/login.php');
    exit;
}
require_once '../../config/database.php';

$getData = $_GET;
if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo "ID de l'article non spécifié ou invalide.";
    exit;
}

$sql="SELECT * 
FROM articles
WHERE id = :id";
// Je transforme l'id en nombre entier pour plus de sécurité
$id = (int) $getData['id'];
$requete = $pdo->prepare($sql);
$requete->execute(['id' => $id]);

$article = $requete->fetch(PDO::FETCH_ASSOC);
if (!$article) {
    echo "Article introuvable.";
    exit;
}
// Je récupère tous les matchs pour les afficher dans la liste déroulante
$sqlMatches = "SELECT * FROM matches ORDER BY date_match DESC";

$requeteMatches = $pdo->query($sqlMatches);

$matches = $requeteMatches->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Modifier un article</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php require_once '../../includes/header.php'; ?>
    <main class="container my-5">

    <h1 class="mb-4">Modifier l'article</h1>
    <form action="update.php" method="post">
        
        <!-- Je garde l'id de l'article dans un champ caché -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']) ?>">

        <div class="mb-3">
            <label for="titre" class="form-label">Titre de l'article</label>
            <input 
                type="text" 
                name="titre" 
                id="titre" 
                class="form-control" 
                value="<?= htmlspecialchars($article['titre']) ?>" 
                required
            >
        </div>

        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu</label>
            <textarea 
                name="contenu" 
                id="contenu" 
                class="form-control" 
                rows="5" 
                required
            ><?= htmlspecialchars($article['contenu']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="auteur" class="form-label">Auteur</label>
            <input 
                type="text" 
                name="auteur" 
                id="auteur" 
                class="form-control" 
                value="<?= htmlspecialchars($article['auteur']) ?>" 
                required
            >
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Nom de l'image</label>
            <input 
                type="text" 
                name="image" 
                id="image" 
                class="form-control" 
                value="<?= htmlspecialchars($article['image']) ?>" 
                required
            >
        </div>

        <div class="mb-3">
            <label for="date_publication" class="form-label">Date de publication</label>
            <input 
                type="date" 
                name="date_publication" 
                id="date_publication" 
                class="form-control" 
                value="<?= htmlspecialchars($article['date_publication']) ?>" 
                required
            >
        </div>

        <div class="mb-3">
            <label for="match_id" class="form-label">Match concerné</label>

            <select name="match_id" id="match_id" class="form-select" required>
                <option value="">Choisir un match</option>

                <?php foreach ($matches as $match) : ?>
                    <option 
                        value="<?= $match['id'] ?>"
                        <?= $match['id'] == $article['match_id'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($match['equipe1']) ?>
                        -
                        <?= htmlspecialchars($match['equipe2']) ?>
                        |
                        <?= htmlspecialchars($match['score']) ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Enregistrer les modifications
        </button>

        <a href="../read/index.php" class="btn btn-outline-secondary">
            Retour
        </a>

    </form>
</main>
<?php require_once '../../includes/footer.php'; ?>
</body>
</html>