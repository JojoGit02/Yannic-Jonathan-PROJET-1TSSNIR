<!DOCTYPE html>
<html>
    <head>
        <title>Supprimer Personne ! </title>
        <meta charset = "utf-8">
        <link rel="stylesheet" href="Style.css">
    </head>
    <body>
    <header>
        <div id="BackgroundHead"><img src="LogoTop1.jpg" style="width:250px"/></div>
    </header>
        <!-- Menu deroulant -->
    <ul id="Menu_Deroulant">
        <li><a href="PageBiblio.php">Accueil </a>
            <ul>
                <li><a href="AfficherLivreAdmin.php">Afficher les livres</a></li>
                <li><a href="AfficherPersonnesAdmin.php">Afficher les personnes</a></li>
                <li><a href="AfficherEmpruntAdmin.php">Afficher les emprunt</a></li>
            </ul>
        </li>
        <li><a href="AfficherLivreAdmin.php"> Afficher les livres </a>
            <ul>
                <li><a href="AjouterUnLivre.php">Ajouter un livre</a></li>
            </ul>
        </li>
        <li><a href="AfficherPersonnesAdmin.php"> Afficher les personnes</a>
            <ul>
                <li><a href="AjouterUnePersonne.php">Ajouter une personne</a>
            </ul>
        </li>
        <li><a href="AfficherEmpruntAdmin.php">Afficher les emprunts </a>
            <ul>
                <li><a href="AjouterUnEmprunt.php">Ajouter un emprunt</a>
            </ul>
        </li>
    </ul>

    <?php
        /*************************************************************************
		Nom du script : SupprimerPersonne.php
        Description :Ce script récupere le numpersonne, se connecte au SGBD MySQL,
				    envoie une requête pour supprimer les données
		    		de la table personne.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/

        //On récupere la valeur du numpersonne
        $numpersonne = $_GET["numpersonne"];
        
        //Données pour se connecter
        $Server = 'localhost';
        $Utilisateur = 'user2';
        $Motdepasse = 'snir@snir2019';
        $Base = 'projet';
            if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
            {
                //Requête SQL 
                $reqSelect = "Select * FROM personne where numpersonne =".$numpersonne;
                if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        //Les données sur la base SQL 
                        $Nom = utf8_encode($row['nom']);
                        $Prenom = utf8_encode($row['prenom']);
                    }
                }
                //Requete SQL pour supprimer le contact dans la base 
                $reqSupp = ("DELETE FROM personne WHERE numpersonne = ".$numpersonne);
                if($result = mysqli_query($conn, $reqSupp, MYSQLI_USE_RESULT))
                {
                    $reqAlterTable = "ALTER TABLE personne AUTO_INCREMENT = 1";
                    if($result1 = mysqli_query($conn,$reqAlterTable,MYSQLI_USE_RESULT))
                    {
                        ?>
                        <script>
                            alert("La personne à bien était supprimer !");
                        </script>
                        <div id="PourValiderSupprimer">
                            <?php
                            echo"La personne $Nom $Prenom à bien était supprimer !<br>";
                            echo"<a href='AfficherPersonnesAdmin.php'>Revenir sur la liste des personnes</a>";
                            ?>
                        </div>
                    <?php
                    }
                }
            } 
    ?>
    <!-- Bouton pour retourner à la page d'accueil -->
    <div>
        <a href="PageBiblio.php">
            <img src="RetourAccueil.PNG" style="width:160px"/>
        </a>
    </div>
    </body>
</html>
