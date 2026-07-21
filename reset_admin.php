<?php

require_once __DIR__ . '/config/database.php';

$email = 'admin@test.com';
$password = '123456';
$nom = 'Belmahria';
$prenom = 'Faten';

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE users 
        SET email = :email,
            nom = :nom,
            prenom = :prenom,
            password = :password
        WHERE id = 1";

$requete = $pdo->prepare($sql);

$requete->execute([
    'email' => $email,
    'nom' => $nom,
    'prenom' => $prenom,
    'password' => $passwordHash
]);

echo "Admin réinitialisé avec succès.";