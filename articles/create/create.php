<?php

require_once '../../config/database.php';

   $sql = "SELECT * FROM matches ORDER BY date_match DESC";

$requete = $pdo->query($sql);

$matches = $requete->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un article</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<main class="container my-5">

    <h1 class="mb-4">Ajouter un nouvel article</h1>

    <form action="store.php" method="POST">

        <div class="mb-3">
            <label for="titre" class="form-label">Titre de l'article</label>
            <input type="text" name="titre" id="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu</label>
            <textarea name="contenu" id="contenu" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="auteur" class="form-label">Auteur</label>
            <input type="text" name="auteur" id="auteur" class="form-control " >
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Nom de l'image</label>
            <input type="text" name="image" id="image" class="form-control" placeholder="exemple : psg.png" required>
        </div>

        <div class="mb-3">
            <label for="date_publication" class="form-label">Date de publication</label>
            <input type="date" name="date_publication" id="date_publication" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="match_id" class="form-label">Match concerné</label>

            <select name="match_id" id="match_id" class="form-select" required>
                <option value="">Choisir un match</option>

                <?php foreach ($matches as $match) : ?>
                    <option value="<?= $match['id'] ?>">
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
            Enregistrer l'article
        </button>

        <a href="/sport-news-crud/articles/index.php" class="btn btn-outline-secondary">
            Retour
        </a>

    </form>

</main>

</body>
</html>