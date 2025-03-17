<?php
class Livre {
    private $utilisateur_id;
    private $google_book_id;
    private $titre;
    private $auteur;
    private $genre;
    private $image;

    public function __construct($utilisateur_id, $google_book_id, $titre, $auteur, $genre, $image) {
        $this->utilisateur_id = $utilisateur_id;
        $this->google_book_id = $google_book_id;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->genre = $genre;
        $this->image = $image;
    }

    public static function addBookToLibrary($utilisateur_id, $google_book_id, $titre, $auteur, $image, $genre) {
        $conn = include_once "includes/database.php";
        $stmt = $conn->prepare("INSERT INTO livres (utilisateur_id, google_book_id, titre, auteur, genre, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $utilisateur_id, $google_book_id, $titre, $auteur, $genre, $image);
        return $stmt->execute();
    }

    public static function getBooksByUser($utilisateur_id) {
        $conn = include_once "includes/database.php";
        $stmt = $conn->prepare("SELECT * FROM livres WHERE utilisateur_id = ?");
        $stmt->bind_param("i", $utilisateur_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function removeBook($utilisateur_id, $google_book_id) {
        $conn = include_once "includes/database.php";
        $stmt = $conn->prepare("DELETE FROM livres WHERE utilisateur_id = ? AND google_book_id = ?");
        $stmt->bind_param("is", $utilisateur_id, $google_book_id);
        return $stmt->execute();
    }
}
?>
