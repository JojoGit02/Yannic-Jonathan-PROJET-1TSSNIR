<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Afficher les livres</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="StylePlus.css">
    </head>
    <body>
    <header>
        <div id="BackgroundHead"><img src="LogoTop1.jpg" style="width:250px"/></div>
    </header>
    <!-- Pour le menu deroulant -->
    <?php
        /*************************************************************************
		Nom du script : AfficherLivre.php
        Description :Ce script se connecte au SGBD MySQL,
                    envoie une requête pour récuperer toutes les données
                    de la table livre.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/

        $EmailConnecter = $_GET["Email"];
        //Données pour se connecter
        $Server = 'localhost';
        $Utilisateur = 'user2';
        $Motdepasse = 'snir@snir2019';
        $Base = 'projet';
        if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
        {
            //Requête SQL
            $reqSelect = "SELECT * FROM compte JOIN personne ON compte.Email = personne.Email where personne.Email ='$EmailConnecter'";
            if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $Email = utf8_encode($row['Email']);
                    $NumPersonne = $row['numpersonne'];
                    $Nom = utf8_encode($row['nom']);
                    $Prenom = utf8_encode($row['prenom']);
                    $Ville = utf8_encode($row['ville']);
                } 
            }
            else
            {
                die ("Erreur !");
            }
        }
        else
        {
            die ("Probleme de connexion au serveur de base de données");
        }
        ?>
    <!-- Menu deroulant -->
    <ul id="Menu_Deroulant">
        <li><a id="TEST" href="PageUtilisateur.php?Email=<?php echo $EmailConnecter?>">Accueil </a>
            <ul>
                <li><a href="AfficherLivre.php?Email=<?php echo $EmailConnecter?>">Afficher les livres</a></li>
                <li><a href="AfficherEmprunt.php?Email=<?php echo $EmailConnecter?>">Afficher vos emprunt</a></li>
            </ul>
        </li>
        <li><a href="AfficherLivre.php?Email=<?php echo $EmailConnecter?>"> Afficher les livres </a>
        </li>
        <li><a href="AfficherEmprunt.php?Email=<?php echo $EmailConnecter?>"> Afficher vos emprunt </a>
        </li>
    </ul>
    <!---------------------------------------------------------------->

    <div id="PositionH1">
        <h1>Les livres de la bibliothéques </h1>
    </div>
        <table id="TableUtilisateur">
            <tr>
                <th>numlivre</th>
                <th>titre</th>
                <th>auteur</th>
                <th>genre</th>
                <th>prix</th>
            </tr>
        <?php
                $Server = 'localhost';
                $Utilisateur = 'user2';
                $Motdepasse = 'snir@snir2019';
                $Base = 'projet';
                if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
                {
                    $reqSelect = "Select * FROM livre";
                    if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $numlivre = $row['numlivre'];
                            $titre = utf8_encode ($row['titre']);
                            $auteur = utf8_encode ($row['auteur']);
                            $genre = utf8_encode ($row['genre']);
                            $prix = $row['prix'];

                            echo"
                            <tr>
                                <td>$numlivre</td>
                                <td>$titre</td>
                                <td>$auteur</td>
                                <td>$genre</td>
                                <td>$prix</td>
                            </tr>";
                        }
                    }
                    else
                    {
                        die ("Erreur !");
                    }
                }
                else
                {
                    die ("Probleme de connexion au serveur de base de données");
                }
        ?>
        <table>
        <div>
            <a href="PageUtilisateur.php?Email=<?php echo $EmailConnecter?>">
                <img src="RetourAccueil.PNG" style="width:160px"/>
            </a>
        </div>
    </body>
</html>
