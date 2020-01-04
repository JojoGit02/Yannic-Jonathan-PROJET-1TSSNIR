<!DOCTYPE html>
<html>
    <head>
        <title>Ajouter un emprunt </title>
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
        <script type="text/javascript">
            function OnClickAjouter (){
                return confirm("Etes vous sur de vouloir ajouter cette emprunt ?");
            }
        </script>
        <?php
        /*************************************************************************
		Nom du script : AjouterUnEmprunt.php
        Description :Ce script se connecte au SGBD MySQL,
                    envoie une requête pour ajouter les données rentrez dans le formulaiure
                    dans la table emprunt.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/

            if(isset($_POST["Valider"]))
            {
                $AjouterNumPersonne = ($_POST['AjouterNumPersonne']);
                $AjouterNumLivre = ($_POST['AjouterNumLivre']);
                $AjouterDateSortie = ($_POST['AjouterDateSortie']);
                $AjouterDateRetour = $_POST['AjouterDateRetour'];

                $AjouterNumPersonne = sanitizeString($AjouterNumPersonne);
                $AjouterNumLivre = sanitizeString($AjouterNumLivre);
                $AjouterDateSortie = sanitizeString($AjouterDateSortie);
                $AjouterDateRetour = sanitizeString($AjouterDateRetour);

                $Server = 'localhost';
                $Utilisateur = 'user2';
                $Motdepasse = 'snir@snir2019';
                $Base = 'projet';

                if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
                {
                    $reqInsert = "INSERT INTO emprunt (numpersonne, numlivre, dateSortie) VALUES ('$AjouterNumPersonne','$AjouterNumLivre','$AjouterDateSortie')";
                    if ($result = mysqli_query($conn, $reqInsert, MYSQLI_USE_RESULT))
                    {
                        ?>
                        <div id="PourValiderSupprimer">
                            <?php
                            echo"L'emprunt à était ajouter !<br>";
                            echo"<a href='AfficherEmpruntAdmin.php'>Revenir sur la liste des emprunt </a>";
                            ?>
                        </div>
                    <?php
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
            }
        else
        {
            //Afficher formulaire   
        ?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="OnClickAjouter();">
        <div id="PositionH1">           
            <h1>Ajouter un emprunt </h1>
        </div>
        <table> 
        <div id="PositionAjouterModifierEmprunt">          
            <div>
                <label id="LabelEmprunt" for="AjouterNumPersonne">NumPersonne:</label>
                <input type="number" id="InputEmprunt" name="AjouterNumPersonne" placeholder="Entrez le numpersonne" required>
            </div>
            <div>
                <label id="LabelEmprunt" for="AjouterNumLivre">NumLivre : </label>
                <input type="number" id="InputEmprunt" name="AjouterNumLivre" placeholder="Entrez le numlivre" required>
            </div>
            <div>
                <label id="LabelEmprunt" for="AjouterDateSortie">Entrez la date de sortie :</label>
                <input type="date" id="InputEmprunt" name="AjouterDateSortie" placeholder="Année/Mois/jour" required>
            <div>
                <label id="LabelEmprunt"for="AjouterDateRetour">Entrez la date de retour :</label>
                <input type="text" id="InputEmprunt" name="AjouterDateRetour" value="NULL">
            </div>
            <div>
                <label id="LabelEmprunt" for="Valider"></label>
                <input type="submit" id="InputEmprunt" name="Valider" value="Valider">
            </div>
        </div>

        <?php
        }
            function sanitizeString($var)
            {
                if (get_magic_quotes_gpc())
                {
                    //Supprimer les slashes
                    $var = stripcslashes($var);
                }
                $var = strip_tags($var);
                $var = htmlentities($var);
                return $var;   
            }
        ?>
        </table>
        </form>
        <!-- Bouton pour retourner à la page d'accueil -->
        <div>
            <a href="PageBiblio.php">
                <img src="RetourAccueil.PNG" style="width:160px"/>
            </a>
        </div>
    </body>
</html>