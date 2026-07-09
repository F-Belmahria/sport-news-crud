<?php

session_start();

require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /*
     * $_POST contient toutes les données envoyées par le formulaire.
     * On les copie dans $postData pour plus de lisibilité.
     */
    $postData = $_POST;

    // Vérifier que email et mdp existent
    if (isset($postData['email']) && isset($postData['mdp'])) {

        // Étape 1 : vérifier le format de l'email
        if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {

            $_SESSION['LOGIN_ERROR_MESSAGE'] = "Il faut saisir un email valide.";

            header('Location: /sport-news-crud/login.php');
            exit;

        } else {

            // Étape 2 : chercher l'utilisateur dans la base
            $sql = "SELECT * FROM users WHERE email = :email";

            $requete = $pdo->prepare($sql);

            $requete->execute([
                'email' => $postData['email']
            ]);

            $user = $requete->fetch(PDO::FETCH_ASSOC);

            // Étape 3 : vérifier le mot de passe
            if ($user && password_verify($postData['mdp'], $user['password'])) {

                /*
                 * Authentification réussie.
                 * On stocke les infos de l'utilisateur en session.
                 * On ne stocke jamais le mot de passe.
                 */
             $_SESSION['LOGGED_USER'] = [
    'id' => $user['id'],
    'email' => $user['email'],
    'nom' => $user['nom'],
    'prenom' => $user['prenom']
];
// Je sécurise la session quand l'utilisateur est connecté
session_regenerate_id(true);

header('Location: /sport-news-crud/');
exit;

   

            } else {

                $_SESSION['LOGIN_ERROR_MESSAGE'] = "Email ou mot de passe incorrect.";

                header('Location: /sport-news-crud/login.php');
                exit;
            }
        }

    } else {

        $_SESSION['LOGIN_ERROR_MESSAGE'] = "Veuillez remplir tous les champs.";

        header('Location: /sport-news-crud/login.php');
        exit;
    }

} else {

    header('Location: /sport-news-crud/login.php');
    exit;
}