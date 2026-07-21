<?php

session_start();

// Je supprime toutes les informations de session
session_destroy();

// Je redirige l'utilisateur vers la page de connexion
header('Location: /sport-news-crud/index.php?page=login');
exit;