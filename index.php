<?php
session_start();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/variables.php';

$title = 'Sport News';
$metadesc = "Sport News : c'est les meilleurs journalistes sportifs spécialisés qui..."; 
// Gestion de l'affichage de la page demandée avec la méthode GET

// On gère d'abord l'affichage d'un article précis
if (
    isset($_GET['page']) &&
    $_GET['page'] === 'show' &&
    isset($_GET['id'])
) {
    $title = "Détail de l'article";

    include __DIR__ . '/includes/header.php';
    include __DIR__ . '/articles/read/show.php';

// Puis les pages autorisées dans la whitelist
} elseif (
    isset($_GET['page']) &&
    array_key_exists($_GET['page'], $whitelist)
) {
    $page = $whitelist[$_GET['page']];
    $title = $page['title'];

    include __DIR__ . '/includes/header.php';
    include $page['file'];
}
//si rien n'est demandé on affiche par defaut la page d'accueil
  elseif (!isset($_GET['page'])) {
    $title = 'Liste des articles';

    include __DIR__ . '/includes/header.php';
    include __DIR__ . '/articles/read/index.php';
  }
  else {
    http_response_code(404);

    $title = 'Page introuvable';

    include __DIR__ . '/includes/header.php';

    echo '<div class="alert alert-danger my-5" role="alert">
        Erreur 404 : page introuvable.
    </div>';
}
include __DIR__ . '/includes/footer.php';