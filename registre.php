<?php
session_start();

require_once __DIR__ . '/config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
     $nom =$postData['nom'];
        $prenom =$postData['prenom'];
        $email =$postData['email'];
        $password =$postData['mdp'];
       
//  1 :vérifier le format de l'email
        if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {

            $_SESSION['REGISTER_ERROR_MESSAGE'] = "Il faut saisir un email valide.";

            header('Location: /sport-news-crud/register.php');
            exit;
        }
        // 2 : chercher l'utilisateur dans la base
            $sql = "SELECT * FROM users WHERE email = :email";

            $requete = $pdo->prepare($sql);

            $requete->execute([
                'email' => $postData['email']
            ]);

            $user = $requete->fetch(PDO::FETCH_ASSOC);
            if ($user){
                  $_SESSION['REGISTER_ERROR_MESSAGE'] = "Cet email est déjà utilisé.";

            header('Location: /sport-news-crud/register.php');
            exit;
            }
            //je ne stockes pas le vrai mot de passe, je stockes sa version sécurisée.
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (nom, prenom, email, password) values(:nom, :prenom, :email, :password)";
            $requete= $pdo-> prepare($sql);
            $requete-> execute([
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
            </head>
            <body>
                <h1>Créer un compte</h1>
                <form method="post" action="/sport-news-crud/register.php">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>

                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required>

                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>

                    <label for="mdp">Mot de passe :</label>
                    <input type="password" id="mdp" name="mdp" required>

                    <button type="submit">S'inscrire</button>
                </form>
            </body>
            </html>