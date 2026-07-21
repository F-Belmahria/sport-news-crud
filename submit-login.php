<?php

session_start();

require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $postData = $_POST;

    if (isset($postData['email']) && isset($postData['mdp'])) {

        if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {

            $_SESSION['LOGIN_ERROR_MESSAGE'] =
                "Il faut saisir un email valide.";

            header(
                'Location: /sport-news-crud/index.php?page=login'
            );
            exit;
        }

        $sql = "SELECT * FROM users WHERE email = :email";

        $requete = $pdo->prepare($sql);

        $requete->execute([
            'email' => $postData['email']
        ]);

        $user = $requete->fetch(PDO::FETCH_ASSOC);

        if (
            $user &&
            password_verify($postData['mdp'], $user['password'])
        ) {
            $_SESSION['LOGGED_USER'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'role' => $user['role']
            ];

            session_regenerate_id(true);

            header(
                'Location: /sport-news-crud/index.php?page=articles'
            );
            exit;
        }

        $_SESSION['LOGIN_ERROR_MESSAGE'] =
            "Email ou mot de passe incorrect.";

        header(
            'Location: /sport-news-crud/index.php?page=login'
        );
        exit;
    }

    $_SESSION['LOGIN_ERROR_MESSAGE'] =
        "Veuillez remplir tous les champs.";

    header(
        'Location: /sport-news-crud/index.php?page=login'
    );
    exit;
}

header('Location: /sport-news-crud/index.php?page=login');
exit;