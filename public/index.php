<?php
// public/index.php
session_start();
include_once '../includes/functions.php';

if (isset($_POST['search'])) {
    $query = $_POST['search'];
    $books = getGoogleBooks($query);
} else {
    $books = getGoogleBooks("fiction");  // Exemple de genre par défaut
}

include_once '../templates/header.php';
?>

<form method="POST">
    <input type="text" name="search" placeholder="Rechercher un livre" />
    <button type="submit">Rechercher</button>
</form>

<div class="books">
    <?php foreach ($books as $book): ?>
        <div class="book">
            <h3><?php echo $book->volumeInfo->title; ?></h3>
            <p><?php echo $book->volumeInfo->authors[0]; ?></p>
            <img src="<?php echo $book->volumeInfo->imageLinks->thumbnail; ?>" alt="Image du livre" />
            <a href="library.php?add=<?php echo $book->id; ?>" class="btn">Ajouter à ma bibliothèque</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include_once '../templates/footer.php'; ?>
