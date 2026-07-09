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
    echo "(Il faut un identifiant valide pour supprimer un article.)";
    exit;
}

// Je transforme l'id en nombre entier pour plus de sécurité
$id = (int) $getData['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Supprimer un article</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php require_once '../../includes/header.php'; ?>
    <main class="container my-5 flex-grow-1">

    <h1 class="mb-4">Supprimer l'article</h1>

    <div class="alert alert-danger">
        Voulez-vous vraiment supprimer cet article ?
    </div>

    <form action="delete-post.php" method="POST">
          <!-- Je garde l'id de l'article dans un champ caché -->
       <div class="mb-3 visually-hidden">
            <label for="id" class="form-label">
                Voulez-vous supprimer l'article <?= htmlspecialchars($id) ?> ?
            </label>

            <input 
                type="hidden" 
                class="form-control" 
                id="id" 
                name="id" 
                value="<?= htmlspecialchars($id) ?>"
            >
        </div>

        <button type="submit" class="btn btn-danger">
            Oui, supprimer
        </button>

        <a class="btn btn-primary" role="button" href="../read/index.php">
            Non, retour
        </a>

    </form>

</main>
<?php require_once '../../includes/footer.php'; ?>
</body>
</html>