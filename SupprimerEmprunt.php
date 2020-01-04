<!DOCTYPE html>
<html>
    <head>
        <title>Supprimer Emprunt ! </title>
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
		Nom du script : SupprimerEmprunt.php
        Description :Ce script récupere le numpersonne et le numlivre, se connecte au SGBD MySQL,
				    envoie une requête pour supprimer les données
		    		de la table emprunt.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/
            
        //Tu recuperes l'id du contact
        $numpersonne = $_GET['numpersonne'];
        $numlivre = $_GET["numlivre"];
        $Server = 'localhost';
        $Utilisateur = 'user2';
        $Motdepasse = 'snir@snir2019';
        $Base = 'projet';
            if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
            {
                //Requete SQL pour supprimer le contact dans la base 
                $reqSupp = ("DELETE FROM emprunt WHERE numpersonne = $numpersonne AND numlivre = ".$numlivre);
                if($result = mysqli_query($conn, $reqSupp, MYSQLI_USE_RESULT))
                {
                    ?>
                    <div id="PourValiderSupprimer">
                        <?php
                        echo"L'emrpunt à était supprimer !<br>";
                        echo"<a href='AfficherEmpruntAdmin.php'>Revenir sur la liste des emprunts</a>";
                        ?>
                    </div>
                <?php
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
