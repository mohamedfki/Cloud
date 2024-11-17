<?php
$databaseHost = '192.168.116.135:8090';
$databaseName = 'test';
$databaseUsername = 'root';
$databasePassword = 'password';

$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ma propre image Docker !</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="#">Ma propre image Docker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Accueil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Articles <span class="sr-only">(current)</span></a>
                </li>

            </ul>
        </div>
    </nav>

    <main role="main" class="container">

        <h1 class="mt-5">Articles</h1>

        <hr>

        <h2 class="mt-5 mb-3">Nouveau article</h2>


        <form action="validation.php" method="post">
            <div class="form-group">
                <label for="title">Titre <span style="color: red; font-weight: bold;">*</span></label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="titre de votre article" required="required">
            </div>

            <div class="form-group">
                <label for="author">Nom de l'auteur <span style="color: red; font-weight: bold;">*</span></label>
                <input type="text" class="form-control" id="author" name="author"
                    placeholder="Nom de l'auteur" required="required">
            </div>

            <div class="form-group">
                <label for="content">Contenu <span style="color: red; font-weight: bold;">*</span></label>
                <textarea class="form-control" id="content" name="content" rows="3"
                    required="required"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

        <hr>

        <h2 class="mt-5 mb-5">Liste d'articles</h2>

        <?php
        $sql = "SELECT * FROM articles ORDER BY id DESC";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $articleTime = date("d/m/y H:i", strtotime($row["date"]));
                ?>
        <div class="card mt-5">
            <div class="card-header">
                <h2 class="h3"><?= $row["title"] ?> <small class="text-muted font-italic"></h2>
                <?= $articleTime ?></small>
            </div>
            <div class="card-body">
                <p class="card-text"><?= $row["content"] ?></p>
                <footer class="blockquote-footer"><cite
                        title="Source Title"><?= $row["author"] ?><cite></footer>
            </div>
        </div>
        <?php
            }
        } else {
            echo "0 results";
        }
        $mysqli->close();
        ?>

    </main>

    <footer class="page-footer font-small bg-dark mt-5">
        <div class="footer-copyright text-center py-3 text-white">© Copyright:
            <a href="#"> MonAppDocker</a>
        </div>
    </footer>

</body>

</html>
