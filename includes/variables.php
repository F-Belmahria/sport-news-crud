<?php

$whitelist = [
    'articles' => [
        'title' => 'Liste des articles',
        'file' => __DIR__ . '/../articles/read/index.php'
    ],

    'create' => [
        'title' => 'Créer un article',
        'file' => __DIR__ . '/../articles/create/create.php'
    ],

    'edit' => [
        'title' => 'Modifier un article',
        'file' => __DIR__ . '/../articles/update/edit.php'
    ],

    'delete' => [
        'title' => 'Supprimer un article',
        'file' => __DIR__ . '/../articles/delete/delete.php'
    ],

    'show' => [
        'title' => "Détail de l'article",
        'file' => __DIR__ . '/../articles/read/show.php'
    ],

    'login' => [
        'title' => 'Connexion',
        'file' => __DIR__ . '/../login.php'
    ],

    'register' => [
        'title' => 'Créer un compte',
        'file' => __DIR__ . '/../register.php'
    ],
    

    'logout' => [
        'title' => 'Déconnexion',
        'file' => __DIR__ . '/../logout.php'
    ]
];