<?php
// Inclure le fichier de configuration qui contient la fonction de connexion à la base de données
include_once '../config/config.php';

class Utilisateur {
    public $id;
    public $nom;
    public $email;
    public $mot_de_passe;

    public function __construct($id, $nom, $email, $mot_de_passe) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
    }

    // Inscription d'un utilisateur
    public static function inscription($nom, $email, $mot_de_passe) {
        $conn = getDatabaseConnection();  // Utilisation de la fonction getDatabaseConnection()
        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nom, $email, password_hash($mot_de_passe, PASSWORD_BCRYPT));
        return $stmt->execute();
    }

    // Connexion de l'utilisateur
    public static function connexion($email, $mot_de_passe) {
        $conn = getDatabaseConnection();  // Utilisation de la fonction getDatabaseConnection()
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($user = $result->fetch_assoc()) {
            if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
                return new Utilisateur($user['id'], $user['nom'], $user['email'], $user['mot_de_passe']);
            }
        }
        return null;
    }

    // Récupérer les livres de l'utilisateur
    public static function getUserBooks($userId) {
        $conn = getDatabaseConnection();  // Utilisation de la fonction getDatabaseConnection()
        $stmt = $conn->prepare("SELECT * FROM livres WHERE utilisateur_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Ajouter un livre à la bibliothèque
    public static function addBookToLibrary($userId, $googleBookId, $titre, $auteur, $image) {
        $conn = getDatabaseConnection();  // Utilisation de la fonction getDatabaseConnection()
        $stmt = $conn->prepare("INSERT INTO livres (utilisateur_id, google_book_id, titre, auteur, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $userId, $googleBookId, $titre, $auteur, $image);
        return $stmt->execute();
    }

    // Récupérer un utilisateur par ID
    public static function getUserById($userId) {
        $conn = getDatabaseConnection();  // Utilisation de la fonction getDatabaseConnection()
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($user = $result->fetch_assoc()) {
            return new Utilisateur($user['id'], $user['nom'], $user['email'], $user['mot_de_passe']);
        }
        return null; // Si l'utilisateur n'existe pas
    }
}
?>

