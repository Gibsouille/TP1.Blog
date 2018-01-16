<?php
    include ("./html/head.html");
?>
        <h1>Formulaire d'ajout de contenu au Blog</h1>
        <form enctype="multipart/form-data" action="./insertion_contenu.php" method="post">
            <label for="titre">Titre :</label><br>
            <input type="text" name="titre"><br>

            <label for="contenu">Commentaire :</label><br>
            <textarea rows="5" cols="50" name="commentaire"></textarea><br>
            
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
            
            <label for="photo">Choisissez une photo avec une taille inférieure à 2 Mo.</label><br>
            <input type="file" id="photo" name="photo" accept=".jpg, .jpeg, .png"><br>

            <button type="submit">Envoyer</button>
        </form>
        
        <a href="./affichage_blog.php">Page d'affichage du blog</a>
<?php
    include ("./html/foot.html");