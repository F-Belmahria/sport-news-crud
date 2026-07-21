<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['LOGGED_USER'])) {
      header('Location: /sport-news-crud/index.php?page=login');
    exit;
}
require_once __DIR__ . '/../../config/database.php';

   $sql = "SELECT * FROM matches ORDER BY date_match DESC";

$requete = $pdo->query($sql);

$matches = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<main class="container my-5 flex-grow-1">

    <h1 class="mb-4">Ajouter un nouvel article</h1>

    <form action="/sport-news-crud/articles/create/store.php" method="POST" enctype ="multipart/form-data">

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
            <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg, image/webp" required>
        </div>

        <div class="mb-3">
            <label for="date_publication" class="form-label">Date de publication</label>
            <input type="date" name="date_publication" id="date_publication" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="match_id" class="form-label">Match concerné</label>

            <select name="match_id" id="match_id" class="form-select" >
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
<div class="form-check mb-3">
     <input 
                class="form-check-input" 
                type="checkbox" 
                name="ajouter_match" 
                id="ajouter_match"
                value="1"
            >

            <label class="form-check-label" for="ajouter_match">
                Ajouter un nouveau match
            </label>
        </div>

        <div id="nouveau_match" class="border rounded p-3 mb-3 d-none">
            <h2 class="h5 mb-3">Informations du nouveau match</h2>

            <div class="mb-3">
                <label for="equipe1" class="form-label">Équipe 1</label>
                <input type="text" name="equipe1" id="equipe1" class="form-control">
            </div>

            <div class="mb-3">
                <label for="equipe2" class="form-label">Équipe 2</label>
                <input type="text" name="equipe2" id="equipe2" class="form-control">
            </div>

            <div class="mb-3">
                <label for="score" class="form-label">Score</label>
                <input type="text" name="score" id="score" class="form-control">
            </div>

            <div class="mb-3">
                <label for="lieu" class="form-label">Lieu</label>
                <input type="text" name="lieu" id="lieu" class="form-control">
            </div>

            <div class="mb-3">
                <label for="date_match" class="form-label">Date du match</label>
                <input type="date" name="date_match" id="date_match" class="form-control">
            </div>

            <div class="mb-3">
                <label for="resume" class="form-label">Résumé du match</label>
                <textarea name="resume" id="resume" class="form-control" rows="3"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            Enregistrer l'article
        </button>

        <a href="/sport-news-crud/index.php?page=articles" class="btn btn-outline-secondary">
            Retour
        </a>

    </form>

</main>

<script>
    const checkboxMatch = document.getElementById('ajouter_match');
    const blocNouveauMatch = document.getElementById('nouveau_match');

    checkboxMatch.addEventListener('change', function () {
        if (checkboxMatch.checked) {
            blocNouveauMatch.classList.remove('d-none');
        } else {
            blocNouveauMatch.classList.add('d-none');
        }
    });
</script>

