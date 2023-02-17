<?php
    include('connect.php');
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Administration</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include('header.php');
    ?>

    <?php
    //verification
    if ($mysqli->connect_errno) {
        echo ("Échec de la connexion : " . $mysqli->connect_error);
        exit();
    }
    ?>
    <div id="wrapper" class='admin'>
        <aside>
            <h2>Mots-clés</h2>
            <?php
            /*
             * Etape 2 : trouver tous les mots clés
             */
            $laQuestionEnSql = "SELECT * FROM `tags` LIMIT 50";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Vérification
            if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli->error);
                exit();
            }

            /*
             * Etape 3 : @todo : Afficher les mots clés en s'inspirant de ce qui a été fait dans news.php
             * Attention à en pas oublier de modifier tag_id=321 avec l'id du mot dans le lien
             */
            while ($tag = $lesInformations->fetch_assoc()) {
                ?>
                <article>
                    <h3>
                        <?php echo $tag['label']; ?>
                    </h3>
                    <p>
                        <?php echo $tag['id']; ?>
                    </p>
                    <nav>
                        <a href=<?php echo "tags.php?tag_id=" . $tag['id'] ?>>Messages</a>
                    </nav>
                </article>
            <?php } ?>
        </aside>
        <main>
            <h2>Utilisatrices</h2>
            <?php
            /*
             * Etape 4 : trouver tous les mots clés
             * PS: on note que la connexion $mysqli à la base a été faite, pas besoin de la refaire.
             */
            $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Vérification
            if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli->error);
                exit();
            }

            while ($tag = $lesInformations->fetch_assoc()) {
                ?>
                <article>
                    <a href="wall.php?user_id=<?php echo $tag['id']; ?>">
                        <h3>
                            <?php echo $tag['alias']; ?>
                        </h3>
                    </a>
                    <p>
                        <?php echo $tag['id']; ?>
                    </p>
                    <nav>
                        <a href="wall.php?user_id=<?php echo $tag['id']; ?>">Mur</a>
                        | <a href="feed.php?user_id=<?php echo $tag['id']; ?>">Flux</a>
                        | <a href="settings.php?user_id=<?php echo $tag['id']; ?>">Paramètres</a>
                        | <a href="followers.php?user_id=<?php echo $tag['id']; ?>">Suiveurs</a>
                        | <a href="subscriptions.php?user_id=<?php echo $tag['id']; ?>">Abonnements</a>
                    </nav>
                </article>
            <?php } ?>
        </main>
    </div>
</body>

</html>