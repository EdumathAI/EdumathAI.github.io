<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['name'], $data['email'], $data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit;
}

$name = $data['name'];
$email = $data['email'];
$password = $data['password'];

// Validation de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Email invalide']);
    exit;
}

// Validation du mot de passe
if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/', $password)) {
    echo json_encode(['success' => false, 'message' => 'Mot de passe non conforme']);
    exit;
}

// Vérification si l'utilisateur existe déjà
$users = json_decode(file_get_contents('users.json'), true);
foreach ($users as $user) {
    if ($user['email'] === $email) {
        echo json_encode(['success' => false, 'message' => 'L\'utilisateur existe déjà']);
        exit;
    }
}

// Hash du mot de passe
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Ajout de l'utilisateur dans le fichier JSON
$users[] = ['name' => $name, 'email' => $email, 'password' => $hashedPassword];
file_put_contents('users.json', json_encode($users));

// Envoi de l'email de confirmation (à implémenter)
echo json_encode(['success' => true, 'message' => 'Inscription réussie']);
?>
