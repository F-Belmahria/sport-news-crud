<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/database.php';

// Je vérifie que le formulaire a bien été envoyé avec la méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Je récupère toutes les données envoyées par le formulaire
    $postData = $_POST;

    if (
        empty($postData['nom']) ||
        empty($postData['prenom']) ||
        empty($postData['email']) ||
        empty($postData['mdp'])
    ) {
        $_SESSION['REGISTER_ERROR_MESSAGE'] = "Tous les champs sont obligatoires.";

        header('Location: /sport-news-crud/register.php');
        exit;
    }

    $nom = $postData['nom'];
    $prenom = $postData['prenom'];
    $email = $postData['email'];
    $password = $postData['mdp'];

    // 1 : vérifier le format de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $_SESSION['REGISTER_ERROR_MESSAGE'] = "Il faut saisir un email valide.";

        header('Location: /sport-news-crud/register.php');
        exit;
    }

    // 2 : chercher l'utilisateur dans la base
    $sql = "SELECT * FROM users WHERE email = :email";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        'email' => $email
    ]);

    $user = $requete->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['REGISTER_ERROR_MESSAGE'] = "Cet email est déjà utilisé.";

        header('Location: /sport-news-crud/register.php');
        exit;
    }

    // Je ne stocke pas le vrai mot de passe, je stocke sa version sécurisée
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nom, prenom, email, password) 
            VALUES (:nom, :prenom, :email, :password)";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'password' => $passwordHash
    ]);

    $_SESSION['REGISTER_SUCCESS_MESSAGE'] = "Inscription réussie.";

    header('Location: /sport-news-crud/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Mon CSS -->
    <link rel="stylesheet" href="/sport-news-crud/assets/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

<?php require_once __DIR__ . '/includes/header.php'; ?>

<main class="container my-5 flex-grow-1">

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h1 class="h3 text-center mb-4">
                        Créer un compte
                    </h1>

                    <?php if (isset($_SESSION['REGISTER_ERROR_MESSAGE'])) : ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($_SESSION['REGISTER_ERROR_MESSAGE']) ?>
                        </div>
                        <?php unset($_SESSION['REGISTER_ERROR_MESSAGE']); ?>
                    <?php endif; ?>

                    <form method="POST" action="/sport-news-crud/register.php">

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input 
                                type="text" 
                                id="nom" 
                                name="nom" 
                                class="form-control" 
                                placeholder="Votre nom"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input 
                                type="text" 
                                id="prenom" 
                                name="prenom" 
                                class="form-control" 
                                placeholder="Votre prénom"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control" 
                                placeholder="exemple@email.com"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="mdp" class="form-label">Mot de passe</label>
                            <input 
                                type="password" 
                                id="mdp" 
                                name="mdp" 
                                class="form-control" 
                                placeholder="Votre mot de passe"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            S'inscrire
                        </button>

                    </form>

                    <p class="text-center mt-3 mb-0">
                        Déjà un compte ?
                        <a href="/sport-news-crud/login.php">
                            Se connecter
                        </a>
                    </p>

                </div>
            </div>

        </div>
    </div>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>