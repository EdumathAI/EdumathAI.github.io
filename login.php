<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email'], $data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit;
}

$email = $data['email'];
$password = $data['password'];

// Chargement des utilisateurs
$users = json_decode(file_get_contents('users.json'), true);

// Recherche de l'utilisateur
foreach ($users as $user) {
    if ($user['email'] === $email && password_verify($password, $user['password'])) {
        echo json_encode(['success' => true, 'message' => 'Connexion réussie']);
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Email ou mot de passe incorrect']);
?>
