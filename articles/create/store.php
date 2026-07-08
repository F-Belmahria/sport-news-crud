<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['LOGGED_USER'])) {
    header('Location: /sport-news-crud/articles/login.php');
    exit;
}
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Je récupère les données envoyées par le formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $auteur = $_POST['auteur'];
    $image = $_POST['image'];
    $date_publication = $_POST['date_publication'];
    $match_id = $_POST['match_id'];

    // Je vérifie que tous les champs obligatoires sont remplis
    if (
        empty($titre) ||
        empty($contenu) ||
        empty($auteur) ||
        empty($image) ||
        empty($date_publication) ||
        empty($match_id)
    ) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    // Je nettoie les données : trim() enlève les espaces et strip_tags() enlève les balises HTML
    $titre = trim(strip_tags($titre));
    $contenu = trim(strip_tags($contenu));
    $auteur = trim(strip_tags($auteur));
    $image = trim(strip_tags($image));

    // Je prépare la requête SQL avec des placeholders
    $sql = "INSERT INTO articles 
            (titre, contenu, auteur, image, date_publication, match_id)
            VALUES
            (:titre, :contenu, :auteur, :image, :date_publication, :match_id)";

    // prepare() prépare la requête SQL
    $insertcontenu = $pdo->prepare($sql);

    // execute() remplace les placeholders par les vraies valeurs et exécute la requête
    $insertcontenu->execute([
        'titre' => $titre,
        'contenu' => $contenu,
        'auteur' => $auteur,
        'image' => $image,
        'date_publication' => $date_publication,

        // Je lie l'article au match sélectionné grâce à la clé étrangère match_id
        'match_id' => $match_id
    ]);

    // Après l'ajout, je retourne vers la page qui affiche les articles
    header('Location: ../read/index.php');
    exit;
}