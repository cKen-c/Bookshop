<?php
// includes/functions.php
include_once '../classes/utilisateur.php';
include_once '../classes/livre.php';

// Fonction pour récupérer des livres depuis l'API Google Books
function getGoogleBooks($query) {
    $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($query) . "&langRestrict=fr";
    $response = file_get_contents($url);
    return json_decode($response)->items;
}
?>
