<?php
session_start();
include_once '../includes/functions.php';
include_once '../config/config.php';  // Inclure le fichier config.php si ce n'est pas déjà fait
include_once '../classes/utilisateur.php';  // Inclure la classe Utilisateur

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirection si l'utilisateur n'est pas connecté
    exit;
}

$userId = $_SESSION['user_id'];

// Récupérer les livres de l'utilisateur
$userBooks = Utilisateur::getUserBooks($userId); // Appel de la méthode pour récupérer les livres

// Ajouter un livre à la bibliothèque
if (isset($_GET['add'])) {
    $googleBookId = $_GET['add'];

    // Récupérer les informations du livre via l'API Google Books
    $url = "https://www.googleapis.com/books/v1/volumes/$googleBookId";
    $response = file_get_contents($url);
    $bookData = json_decode($response, true);

    // Extraire les informations nécessaires
    $titre = $bookData['volumeInfo']['title'];
    $auteur = $bookData['volumeInfo']['authors'][0];
    $image = $bookData['volumeInfo']['imageLinks']['thumbnail'];

    // Ajouter le livre à la bibliothèque
    Utilisateur::addBookToLibrary($userId, $googleBookId, $titre, $auteur, $image);
    header('Location: library.php'); // Recharger la page pour voir le livre ajouté
    exit;
}

include_once '../templates/header.php'; // Inclusion du header
?>

<div class="container">
    <h1>Ma bibliothèque</h1>
    <div class="row">
        <?php foreach ($userBooks as $book): ?>
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="<?php echo $book['image']; ?>" alt="Livre">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $book['titre']; ?></h5>
                        <p class="card-text"><?php echo $book['auteur']; ?></p>
                        <a href="library.php?remove=<?php echo $book['id']; ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include_once '../templates/footer.php'; ?>

