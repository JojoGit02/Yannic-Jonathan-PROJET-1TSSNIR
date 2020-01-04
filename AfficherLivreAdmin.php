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
    <!--Javascript pour le bouton supprimer -->
    <script type="text/javascript">
        function OnClickSupprimer () {
            return confirm("Etes vous sur de supprimer ce livre ?");
        }
    </script>
    <div id="PositionH1">
        <h1>Les livres de la bibliothéques </h1>
    </div>
        <table id="TableAdmin">
            <tr>
                <th>numlivre</th>
                <th>titre</th>
                <th>auteur</th>
                <th>genre</th>
                <th>prix</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            /*************************************************************************
            Nom du script : AfficherLivreAdmin.php
            Description :Ce script se connecte au SGBD MySQL,
                        envoie une requête pour récuperer toutes les données
                        de la table livre.
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
                    $reqSelect = "Select * FROM livre";
                    if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            //On récupere les données
                            $numlivre = $row['numlivre'];
                            $titre = utf8_encode ($row['titre']);
                            $auteur = utf8_encode ($row['auteur']);
                            $genre = utf8_encode ($row['genre']);
                            $prix = $row['prix'];

                            //On affiche les données récupérer
                            echo"
                            <tr>
                                <td>$numlivre</td>
                                <td>$titre</td>
                                <td>$auteur</td>
                                <td>$genre</td>
                                <td>$prix</td>"
                                ?>

                                <!--Bouton pour Modifier -->
                                <td>
                                    <form action="ModificationLivre.php?numlivre=<?php echo $numlivre;?>" method="post">
                                        <input type="submit" value="Modifier">
                                    </form>
                                </td> 

                                <!--Bouton pour Supprimer -->
                                <td>
                                <form action="SupprimerLivre.php?numlivre=<?php echo $numlivre;?>" method="post" onsubmit="return OnClickSupprimer();">
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
        <!-- Bouton pour ajouter un livre -->
        <form action="AjouterUnLivre.php" method="post">
            <div id="ButtonAjouter">
                <input type="submit" name="AjouterLivre" value="Ajouter un livre" style="width:300px;font-size:1.8em">
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