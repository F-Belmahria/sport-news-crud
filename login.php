<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
<?php require_once __DIR__ . '/includes/header.php'; ?>
<main class="container my-5 flex-grow-1">

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h1 class="h3 text-center mb-4">Connexion</h1>

                    <?php if (!empty($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($_SESSION['LOGIN_ERROR_MESSAGE']) ?>
                        </div>

                        <?php unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['REGISTER_SUCCESS_MESSAGE'])) : ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($_SESSION['REGISTER_SUCCESS_MESSAGE']) ?>
                        </div>

                        <?php unset($_SESSION['REGISTER_SUCCESS_MESSAGE']); ?>
                    <?php endif; ?>

                    <form action="/sport-news-crud/submit-login.php" method="POST">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>

                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control" 
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="mdp" class="form-label">Mot de passe</label>

                            <input 
                                type="password" 
                                name="mdp" 
                                id="mdp" 
                                class="form-control" 
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Se connecter
                        </button>

                    </form>

                    <p class="text-center mt-3 mb-0">
                        Pas encore de compte ?
                        <a href="/sport-news-crud/register.php">
                            Créer un compte
                        </a>
                    </p>

                </div>
            </div>

        </div>
    </div>

</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
</body>
</html>