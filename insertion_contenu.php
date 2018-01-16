<?php
    include ("./html/head.html");
    
    $uploaddir = './photos/';
    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);

    echo '<pre>';
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile) && isset($_POST['titre'])) {
        $titre = $_POST['titre'];
        $commentaire = $_POST['commentaire'];
        $chemin_photo = $_FILES['photo']['name'];
        
        if (empty(trim($commentaire)))
            $commentaire = NULL;
        
        try {
            $connexionDB = new PDO("mysql:host=localhost;dbname=blog", "root", ""); // connexion bdd
            
            $insertContenu = $connexionDB->prepare("INSERT INTO contenu(titre, commentaire, chemin_photo) values(:titre, :commentaire, :chemin_photo)");
            $insertContenu->execute(array(
                'titre' => $titre,
                'commentaire' => $commentaire,
                'chemin_photo' => $chemin_photo
            ));
            
            echo "Aucune erreur dans le transfert du fichier.\n"
                . "Le fichier " . $_FILES['photo']['name'] . " a été copié dans le répertoire photos.\n"
                . "Ajout du commentaire réussi.\n";
        }
        catch (PDOException $ex) {
            echo 'Erreur : ' . $ex.getMessage() . '\n';
        }
    } else {
        echo "Le fichier n'a pas pu être téléchargé. Vérifiez les entrées du formulaire.\n";
    }
    
    echo '</pre>';
    
    echo '<a href="./formulaire_ajout.php">Retour à la page d\'insertion</a>';
    
    include ("./html/foot.html");