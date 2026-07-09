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

<body>

<main class="container my-5">
     
         
   <?php if (!empty($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['LOGIN_ERROR_MESSAGE']) ?>
        </div>

        <?php unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
    <?php endif; ?>
   
 <form action="/sport-news-crud/submit-login.php" method="POST" class="w-50">

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

        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>

            <input 
                type="password" 
                name="mdp" 
                id="mdp" 
                class="form-control" 
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Se connecter
        </button>
        <a href="/sport-news-crud/register.php" class="btn btn-success ms-2">
    Créer un compte
</a>

    </form>

</main>

</body>
</html>