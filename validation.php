<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db-config.php';

function validateAndInsert(mysqli $mysqli) {
    if (!isset($_POST["title"]) || empty($_POST["title"])) {
        echo '<p style="color: red; font-weight: bold;">Il manque le titre de l\'article</p>';
    } elseif (!isset($_POST["author"]) || empty($_POST["author"])) {
        echo '<p style="color: red; font-weight: bold;">Il manque le nom de l\'auteur de l\'article</p>';
    } elseif (!isset($_POST["content"]) || empty($_POST["content"])) {
        echo '<p style="color: red; font-weight: bold;">Il manque le contenu de l\'article</p>';
    } else {
        // Sanitize inputs to prevent SQL injection
        $title = mysqli_real_escape_string($mysqli, $_POST["title"]);
        $author = mysqli_real_escape_string($mysqli, $_POST["author"]);
        $content = mysqli_real_escape_string($mysqli, $_POST["content"]);

        $sql = "INSERT INTO articles (title, author, content) VALUES ('$title', '$author', '$content')";

        if (mysqli_query($mysqli, $sql)) {
            echo '<p style="color: green; font-weight: bold;">Article ajouté avec succès</p>';
        } else {
            echo '<p style="color: red; font-weight: bold;">Erreur lors de l\'ajout de l\'article: ' . mysqli_error($mysqli) . '</p>';
        }
    }
    echo '<p><a href="index.php">Accueil</a></p>';
}

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

validateAndInsert($mysqli);

mysqli_close($mysqli);
?>
