<?php
session_start();
?>

<form method="GET">
    <input type="text" name="query" placeholder="Rechercher un livre">
    <button type="submit">Rechercher</button>
</form>

<?php
if (isset($_GET["query"])) {
    $query = urlencode($_GET["query"]);
    $url = "https://www.googleapis.com/books/v1/volumes?q=$query&langRestrict=fr";

    $response = file_get_contents($url);
    $books = json_decode($response, true)["items"];

    foreach ($books as $book) {
        $id = $book["id"];
        $titre = $book["volumeInfo"]["title"] ?? "Titre inconnu";
        $auteur = $book["volumeInfo"]["authors"][0] ?? "Auteur inconnu";
        $image = $book["volumeInfo"]["imageLinks"]["thumbnail"] ?? "";

        echo "<div>
                <img src='$image' alt='Image'>
                <h3>$titre</h3>
                <p>$auteur</p>";

        if (isset($_SESSION["user_id"])) {
            echo "<form method='POST' action='ajouter_livre.php'>
                    <input type='hidden' name='id' value='$id'>
                    <input type='hidden' name='titre' value='$titre'>
                    <input type='hidden' name='auteur' value='$auteur'>
                    <input type='hidden' name='image' value='$image'>
                    <button type='submit'>Ajouter à ma bibliothèque</button>
                  </form>";
        }

        echo "</div>";
    }
}
?>
