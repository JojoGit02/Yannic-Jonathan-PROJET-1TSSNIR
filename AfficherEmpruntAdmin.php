<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Afficher les emprunts</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="StylePlus.css">
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
    <script type="text/javascript">
        function OnClickSupprimer () {
            return confirm("Etes vous sur de supprimer cette emprunt ?");
        }
    </script>
    <div id="PositionH1">
        <h1>Les emprunts :</h1>
    </div>
        <table id="TableAdminEmprunt">
            <tr>
                <th>numpersonne</th> 
                <th>numlivre</th>
                <th>Date de sortie :</th>
                <th>Date de retour :</th> 
                <th></th>
                <th></th>
            </tr>
        <?php
        /*************************************************************************
		Nom du script : AfficherEmpruntAdmin.php
        Description :Ce script se connecte au SGBD MySQL,
                    envoie une requête pour récuperer toutes les données
                    de la table emprunt.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/

                $Server = 'localhost';
                $Utilisateur = 'user2';
                $Motdepasse = 'snir@snir2019';
                $Base = 'projet';
                if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
                {
                    $reqSelect = "SELECT * FROM emprunt ";
                    if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $numpersonne = $row['numpersonne'];
                            $numlivre =  $row['numlivre'];
                            $DateSortie = $row['dateSortie'];
                            $DateRetour = $row['dateRetour'];

                            echo"
                            <tr>
                                <td>$numpersonne</td>
                                <td>$numlivre</td>
                                <td>$DateSortie</td>
                                <td>$DateRetour</td>"
                                ?>
                                <td>
                                <form action="ModifierEmprunt.php?numpersonne=<?php echo $numpersonne;?> && numlivre=<?php echo $numlivre;?>" method="post">
                                <input type="submit" value="Modifier">
                                </form>
                                </td> 
                                <td>
                                <form action="SupprimerEmprunt.php?numpersonne=<?php echo $numpersonne;?> && numlivre=<?php echo $numlivre;?>" method="post" onsubmit="return OnClickSupprimer();">
                                <input type="submit" name="Supprimer" value="Supprimer"></a>
                                </form>
                                </td> 
                            </tr>
                        <?php
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
        <form action="AjouterUnEmprunt.php" method="post">
            <div id="ButtonAjouter">
                <input type="submit" name="AjouterEmprunt" value="Ajouter un emprunt !" style="width:300px;font-size:1.8em">
            </div>
        </form>
            <!-- Bouton pour retourner à la page d'accueil -->
            <div>
                <a href="PageBiblio.php">
                    <img src="RetourAccueil.PNG" style="width:160px"/>
                </a>
            </div>
    </body>
</html>
