<?php
include "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $mot_de_passe = $_POST["mot_de_passe"];

    $query = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mot_de_passe, $user["mot_de_passe"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["nom"] = $user["nom"];
        header("Location: index.php");
        exit;
    } else {
        echo "Identifiants incorrects.";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>
