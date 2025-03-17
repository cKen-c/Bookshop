<?php
session_start(); // Assurer que la session est démarrée pour accéder aux variables $_SESSION

// Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Récupérer les informations de l'utilisateur connecté depuis la base de données
include_once '../includes/database.php'; // Pour établir la connexion à la base de données
include_once '../classes/utilisateur.php';

$userId = $_SESSION['user_id']; // ID de l'utilisateur connecté
$user = Utilisateur::getUserById($userId); // Obtenir les informations de l'utilisateur

// Vérifier si les informations de l'utilisateur sont récupérées
if ($user) {
    // Afficher les informations de l'utilisateur (par exemple, nom, email, etc.)
    echo "<h1>Profil de " . $user['nom'] . "</h1>";
    echo "<p>Email: " . $user['email'] . "</p>";
    // Afficher plus d'informations si nécessaire
} else {
    echo "<p>Erreur lors de la récupération des informations utilisateur.</p>";
}
?>
