<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['LOGGED_USER'])) {
    header('Location: /sport-news-crud/index.php?page=login');
    exit;
}
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Je récupère les données envoyées par le formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $auteur = $_POST['auteur'];
    
    $date_publication = $_POST['date_publication'];
    $match_id = $_POST['match_id'];

    // Je vérifie que tous les champs obligatoires sont remplis
    if (
        empty($titre) ||
        empty($contenu) ||
        empty($auteur) ||
       
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
    $image =  'default.png';

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
// Je récupère l'id de l'article qui vient d'être ajouté
// Cet id va servir à renommer l'image
$article_id = $pdo->lastInsertId();


// ============================================================
// TRAITEMENT DE L'UPLOAD D'IMAGE
// ============================================================

// Je vérifie qu'une image a été envoyée et qu'il n'y a pas d'erreur
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    // Je vérifie le vrai type du fichier
    $typeMime = mime_content_type($_FILES['image']['tmp_name']);

    // J'accepte seulement les images JPG / JPEG ou png
   if ($typeMime === "image/jpeg" || $typeMime === "image/png") {

        // Je choisis le dossier où l'image sera enregistrée
        $dossier = __DIR__ . '/../../assets/images/';

        // Je donne un nom à l'image avec l'id de l'article
        // Exemple : si l'article a l'id 5, l'image sera 5.jpg
        $nomFichier = $article_id . ".jpg";

        // Je déplace l'image dans le dossier assets/images
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $nomFichier)) {

            // Je mets à jour l'article avec le vrai nom de l'image
            $updateImage = $pdo->prepare("
                UPDATE articles 
                SET image = :image 
                WHERE id = :id
            ");

            $updateImage->execute([
                'image' => $nomFichier,
                'id' => $article_id
            ]);
        }

    } else {
        echo "Erreur : seul le format JPG et PNG son  accepté.";
        exit;
    }
}
    // Après l'ajout, je retourne vers la page qui affiche les articles
   header('Location: /sport-news-crud/index.php?page=articles');
exit;
   
}