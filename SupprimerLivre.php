<!DOCTYPE html>
<html>
    <head>
        <title>Supprimer Livre </title>
        <meta charset="utf-8">
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
		Nom du script : SupprimerLivre.php
        Description :Ce script récupere le numlivre, se connecte au SGBD MySQL,
				    envoie une requête pour supprimer les données
		    		de la table livre.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/

        //On récupere la valeur de numlivre 
        $numlivre = $_GET["numlivre"];
        //Données pour se connecter
        $Server = 'localhost';
        $Utilisateur = 'user2';
        $Motdepasse = 'snir@snir2019';
        $Base = 'projet';
            if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
            {
                $reqSelect = "Select * FROM livre where numlivre=".$numlivre;
                if($result2 = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
                {
                    while($row = mysqli_fetch_assoc($result2))
                    {
                        //On récupere les données
                        $titre = utf8_encode ($row['titre']);
                        $auteur = utf8_encode ($row['auteur']);
                    }
                }
                //Requete SQL pour supprimer le contact dans la base 
                $reqSupp = ("DELETE FROM livre WHERE numlivre = ".$numlivre);
                if($result = mysqli_query($conn, $reqSupp, MYSQLI_USE_RESULT))
                {
                    $reqAlterTable = "ALTER TABLE livre AUTO_INCREMENT = 1";
                    if($result1 = mysqli_query($conn,$reqAlterTable,MYSQLI_USE_RESULT))
                    {
                        ?>
                        <script type="text/javascript">
                            alert("Le livre à était supprimer !");
                        </script>
                    <div id="PourValiderSupprimer">
                    <?php
                        echo "Le livre $titre de $auteur à bien était supprimer !<br>";
                        echo "<a href='AfficherLivreAdmin.php'>Revenir sur la liste des livres ! </a>";
                    ?>
                    </div>
                    <?php
                    }
                }
            } 
    ?>
    <div>
        <a href="PageBiblio.php">
            <img src="RetourAccueil.PNG" style="width:160px"/>
        </a>
    </div>
    </body>
</html>
