<?php
include "config.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    die("Veuillez vous connecter.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $google_book_id = $_POST["id"];
    $titre = $_POST["titre"];
    $auteur = $_POST["auteur"];
    $image = $_POST["image"];

    $query = $pdo->prepare("INSERT INTO livres (user_id, google_book_id, titre, auteur, image) VALUES (?, ?, ?, ?, ?)");

    try {
        $query->execute([$user_id, $google_book_id, $titre, $auteur, $image]);
        echo "Livre ajouté à votre bibliothèque !";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
