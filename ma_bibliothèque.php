<?php
include "config.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    die("Veuillez vous connecter.");
}

$query = $pdo->prepare("SELECT * FROM livres WHERE user_id = ?");
$query->execute([$_SESSION["user_id"]]);
$livres = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($livres as $livre) {
    echo "<div>
            <img src='{$livre['image']}' alt='Image'>
            <h3>{$livre['titre']}</h3>
            <p>{$livre['auteur']}</p>
            <form method='POST' action='supprimer_livre.php'>
                <input type='hidden' name='id' value='{$livre['id']}'>
                <button type='submit'>Supprimer</button>
            </form>
          </div>";
}
?>
