<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['LOGGED_USER'])) {
    header('Location: /sport-news-crud/index.php?page=login');
    exit;
}
require_once __DIR__ . '/../../config/database.php';

$getData = $_GET;
if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo "(Il faut un identifiant valide pour supprimer un article.)";
    exit;
}

// Je transforme l'id en nombre entier pour plus de sécurité
$id = (int) $getData['id'];
?>

    <main class="container my-5 flex-grow-1">

    <h1 class="mb-4">Supprimer l'article</h1>

    <div class="alert alert-danger">
        Voulez-vous vraiment supprimer cet article ?
    </div>

    <form action="/sport-news-crud/articles/delete/delete-post.php" method="POST">
          <!-- Je garde l'id de l'article dans un champ caché -->
       <div class="mb-3 visually-hidden">
            <label for="id" class="form-label">
                Voulez-vous supprimer l'article <?= ($id) ?> ?
            </label>

            <input 
                type="hidden" 
                class="form-control" 
                id="id" 
                name="id" 
                value="<?= ($id) ?>"
            >
        </div>

        <button type="submit" class="btn btn-danger">
            Oui, supprimer
        </button>

        <a class="btn btn-primary" role="button" href="/sport-news-crud/index.php?page=articles">
            Non, retour
        </a>

    </form>

</main>
