<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Afficher vos emprunt</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="StylePlus.css">
    </head>
    <body>
    <!-------------------------------------------------------------------
	Nom du script : AfficherEmprunt.php
        Description :Ce script se connecte avec les données pour la connexion ADMIN ou bien,
                    ce script se connecte au SGBD MySQL,
				    envoie une requête pour recuperrer les données
		    		de la table compte et affiche les droit clients .
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
     ----------------------------------------------------------------------->
    <header>
        <div id="BackgroundHead"><img src="LogoTop1.jpg" style="width:250px"/></div>
    </header>
    <!------------------------- Pour le menu déroulant ------------------------------->
    <?php
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
    <!------------------------------ Fin menu deroulant ---------------------------------->

    <div id="PositionH1">
        <h1>Vos emprunt :</h1>
    </div>
        <table id="TableUtilisateur">
            <tr>
                <th>numlivre</th> 
                <th>Titre</th>
                <th>Auteur</th>
                <th>Prix</th>
                <th>Date de sortie </th>
                <th>Date de retour </th> 
            </tr>
        <?php
                $EmailConnecter = $_GET["Email"];
                $Server = 'localhost';
                $Utilisateur = 'user2';
                $Motdepasse = 'snir@snir2019';
                $Base = 'projet';
                if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
                {
                    $reqSelect = "SELECT * FROM emprunt JOIN personne ON emprunt.numpersonne = personne.numpersonne JOIN livre ON emprunt.numlivre = livre.numlivre WHERE personne.numpersonne ='$NumPersonne'";
                    if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $numlivre = $row['numlivre'];
                            $Titre = utf8_encode($row['titre']);
                            $Auteur = utf8_encode($row['auteur']);
                            $Prix = $row['prix'];
                            $DateSortie = utf8_encode ($row['dateSortie']);
                            $DateRetour = utf8_encode ($row['dateRetour']);

                            echo"
                            <tr>
                                <td>$numlivre</td>
                                <td>$Titre</td>
                                <td>$Auteur</td>
                                <td>$Prix</td>
                                <td>$DateSortie</td>
                                <td>$DateRetour</td>
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
