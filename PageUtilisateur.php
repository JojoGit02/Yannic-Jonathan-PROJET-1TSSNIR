<!DOCTYPE html>
<html>
    <head>
        <title>Page Utilisateur</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Style.css">
    </head>
    <body>
    <header>
        <div id="BackgroundHead"><img src="LogoTop1.jpg" style="width:250px"/></div>
    </header>
        <script type="text/javascript">
            function OnClickDeconnexion(){
                return confirm("Etes vous sur de vouloir vous déconnecter ?");
            }
        </script>
        <?php
        /**************************************
         Nom du script : PageUtilisateur.php
        Description : Ce script affiche les fonctionnalités pour les clients 
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
        ******************************************/

        //On récupere la valeur de l'email qui s'est connecte
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
            <h1>Bonjour <?php echo "$Nom $Prenom";?> voici vos droit !</h1>
        </div>
        <div id="PositionPourUtilisateur">
            <a href="AfficherLivre.php?Email=<?php echo $EmailConnecter?>">Afficher les livres de la bibliothéques</a> <br>
            <a href="AfficherEmprunt.php?Email=<?php echo $EmailConnecter ?>">Afficher vos emprunt </a> <br>

            <form action="index.html" method="post" onsubmit="return OnClickDeconnexion();">
                <div>
                    <input type="submit" name="Deconnexion" value="Deconnexion">
                </div>
            </form>
        </div>
    </body>
</html>
