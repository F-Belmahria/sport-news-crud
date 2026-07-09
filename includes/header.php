<?php
// Je vérifie si aucune session n’est encore démarrée.
// Si aucune session n’existe, je démarre une nouvelle session.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/sport-news-crud/assets/css/style.css">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container d-flex align-items-center">

        <!-- Logo à gauche -->
        <a 
            class="navbar-brand fw-bold me-auto" 
            href="<?= isset($_SESSION['LOGGED_USER']) 
                ? '/sport-news-crud/' 
                : '/sport-news-crud/login.php' ?>"
        >
            Sport News
        </a>

        <!-- Menu au centre -->
        <div class="navbar-nav mx-auto">
            <a 
                class="nav-link px-3" 
                href="<?= isset($_SESSION['LOGGED_USER']) 
                    ? '/sport-news-crud/' 
                    : '/sport-news-crud/login.php' ?>"
            >
                Articles
            </a>

            <a 
                class="nav-link px-3" 
                href="<?= isset($_SESSION['LOGGED_USER']) 
                    ? '/sport-news-crud/articles/create/create.php' 
                    : '/sport-news-crud/login.php' ?>"
            >
                Ajouter un article
            </a>
        </div>

        <!-- Boutons à droite -->
        <div class="d-flex align-items-center gap-2 ms-auto">

            <?php if (isset($_SESSION['LOGGED_USER'])) : ?>

                <span class="text-white">
                    Bonjour <?= htmlspecialchars($_SESSION['LOGGED_USER']['prenom']) ?>
                </span>

                <a href="/sport-news-crud/logout.php" class="btn btn-outline-light btn-sm">
                    Déconnexion
                </a>

            <?php else : ?>

                <a href="/sport-news-crud/login.php" class="btn btn-outline-light btn-sm">
                    Connexion
                </a>

                <a href="/sport-news-crud/register.php" class="btn btn-success btn-sm">
                    Créer un compte
                </a>

            <?php endif; ?>

        </div>

    </div>
</nav>
</header>