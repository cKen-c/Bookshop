<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlspecialchars($_POST["email"]);
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);

    $query = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");
    
    try {
        $query->execute([$nom, $email, $mot_de_passe]);
        echo "Inscription réussie ! <a href='connexion.php'>Connectez-vous</a>";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<form method="POST">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>
