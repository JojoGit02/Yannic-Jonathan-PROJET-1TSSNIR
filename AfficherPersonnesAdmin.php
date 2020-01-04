<!DOCTYPE html>
<html>
    <head>
        <title> Afficher les personnes </title>
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
            return confirm("Etes vous sur de supprimer cette personne ?");
        }
    </script>
    <div id="PositionH1">
        <h1>Afficher les personnes </h1>
    </div>
        <table id="TableAdmin">
            <tr>
                <th>numpersonne</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Ville</th>
                <th>Email</th>
                <th></th>
                <th></th>
            </tr>
        <?php
        /*************************************************************************
		Nom du script : AfficherPersonnesAdmin.php
        Description :Ce script se connecte au SGBD MySQL,
                    envoie une requête pour récuperer toutes les données
                    de la table personne.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/
            
                //Données pour se connecter
                $Server = 'localhost';
                $Utilisateur = 'user2';
                $Motdepasse = 'snir@snir2019';
                $Base = 'projet';
                if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
                {
                    //Requête SQL 
                    $reqSelect = "Select * FROM personne";
                    if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            //Les données sur la base SQL 
                            $numpersonne = $row['numpersonne'];
                            $Nom = utf8_encode ($row['nom']);
                            $Prenom = utf8_encode ($row['prenom']);
                            $Ville = utf8_encode ($row['ville']);
                            $Email = utf8_encode($row['Email']);

                            //On affiche les données
                            echo"
                            <tr>
                                <td>$numpersonne</td>
                                <td>$Nom</td>
                                <td>$Prenom</td>
                                <td>$Ville</td>
                                <td>$Email</td>"
                                ?>
                                <!-- Bouton pour modifier une personne -->
                                <td>
                                    <form action="ModifierUnePersonne.php?numpersonne=<?php echo $numpersonne;?>" method="post">
                                        <input type="submit" value="Modifier">
                                    </form>
                                </td> 

                                <!-- Bouton pour supprimer une personne -->
                                <td>
                                    <form action="SupprimerPersonne.php?numpersonne=<?php echo $numpersonne;?>" method="post" onsubmit="return OnClickSupprimer();">
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
        </table>
        <!-- Bouton pour ajouter une personne -->
        <form action="AjouterUnePersonne.php" method="post">
            <div id="ButtonAjouter">
                <input type="submit" name="AjouterPersonne" value="Ajouter une personne !" style="width:320px;font-size:1.8em">
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