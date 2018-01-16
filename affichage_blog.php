<?php
    include ("./html/head.html");
?>
        <h1>Blog</h1>
        <hr>
<?php
    try {
        $connexionDB = new PDO("mysql:host=localhost;dbname=blog", "root", ""); // connexion bdd
        $selectContenus = "select * from contenu order by date_entree asc";
        $reponse = $connexionDB->query($selectContenus); // exécution de la requête ci-dessus

        if ($reponse->rowCount() == 0) {
            echo "<p>Aucun contenu</p>";
        }
        else {
            while (($contenu = $reponse->fetch())) {
                $nom_image = $contenu['CHEMIN_PHOTO'];
                $source_image = "./photos/" . $nom_image;
                echo '
                <section>
                    <h2>' . $contenu['TITRE'] . '</h2>
                    <h3>Le ' . $contenu['DATE_ENTREE'] . '</h3>
                    <p>' . $contenu['COMMENTAIRE'] . '</p>
                    <img src="' . $source_image . '" alt="' . $nom_image . '" />
                    <hr>
                </section>';
            }
            $reponse->closeCursor();
        }
    }
    catch (PDOException $ex) {
        echo 'Erreur : ' . $ex.getMessage() . '\n';
    }
    
    echo '<a href="./formulaire_ajout.php">Insérer du nouveau contenu</a>';
    
    include ("./html/foot.html");