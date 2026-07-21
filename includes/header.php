<?php

// Démarre la session uniquement si elle n'est pas déjà active.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="<?= htmlspecialchars(
            $metadesc ?? 'Sport News : actualités et résultats sportifs',
            ENT_QUOTES,
            'UTF-8'
        ) ?>"
    >

    <title>
        <?= htmlspecialchars(
            $title ?? 'Sport News',
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
   <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >
    <!-- CSS du projet -->
    <link
        rel="stylesheet"
        href="/sport-news-crud/assets/css/style.css"
    >
</head>

<body class="d-flex flex-column min-vh-100">

<header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

        <div class="container d-flex align-items-center">

            <!-- Logo -->
            <a
                class="navbar-brand fw-bold me-auto"
                href="<?= isset($_SESSION['LOGGED_USER'])
                    ? '/sport-news-crud/index.php?page=articles'
                    : '/sport-news-crud/index.php?page=login'
                ?>"
            >
                Sport News
            </a>

            <!-- Bouton du menu sur mobile -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Afficher le menu"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenu du menu -->
            <div
                class="collapse navbar-collapse"
                id="mainNavbar"
            >

                <!-- Navigation centrale -->
                <div class="navbar-nav mx-auto">

                    <a
                        class="nav-link px-3"
                        href="<?= isset($_SESSION['LOGGED_USER'])
                            ? '/sport-news-crud/index.php?page=articles'
                            : '/sport-news-crud/index.php?page=login'
                        ?>"
                    >
                        Articles
                    </a>

                    <a
                        class="nav-link px-3"
                        href="<?= isset($_SESSION['LOGGED_USER'])
                            ? '/sport-news-crud/index.php?page=create'
                            : '/sport-news-crud/index.php?page=login'
                        ?>"
                    >
                        Ajouter un article
                    </a>

                </div>

                <!-- Partie droite -->
                <div class="d-flex align-items-center gap-2">

                    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>

                        <span class="text-white">
                            Bonjour
                            <?= htmlspecialchars(
                                $_SESSION['LOGGED_USER']['prenom'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </span>

                        <a
                            href="/sport-news-crud/index.php?page=logout"
                            class="btn btn-outline-light btn-sm"
                        >
                            Déconnexion
                        </a>

                    <?php else : ?>

                        <a
                            href="/sport-news-crud/index.php?page=login"
                            class="btn btn-outline-light btn-sm"
                        >
                            Connexion
                        </a>

                        <a
                            href="/sport-news-crud/index.php?page=register"
                            class="btn btn-success btn-sm"
                        >
                            Créer un compte
                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </nav>

</header>