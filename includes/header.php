<?php
// Je vérifie si aucune session n’est encore démarrée.
// Si aucune session n’existe, je démarre une nouvelle session.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container ">

            <a class="navbar-brand fw-bold" 
                 href="<?= isset($_SESSION['LOGGED_USER']) 
        ? '/sport-news-crud/articles/read/index.php' 
        : '/sport-news-crud/login.php' ?>">
                Sport News
            </a>

            <div class="navbar-nav me-auto">
                <a class="nav-link" 
                     href="<?= isset($_SESSION['LOGGED_USER']) 
        ? '/sport-news-crud/articles/read/index.php' 
        : '/sport-news-crud/login.php' ?>"
>
                    Articles
                </a>

               <a 
    class="nav-link" 
    href="<?= isset($_SESSION['LOGGED_USER']) 
        ? '/sport-news-crud/articles/create/create.php' 
        : '/sport-news-crud/login.php' ?>"
>
    Ajouter un article
</a>
            </div>

            <div class="d-flex align-items-center gap-2">

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