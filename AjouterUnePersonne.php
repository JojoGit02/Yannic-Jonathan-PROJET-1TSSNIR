<!DOCTYPE html>
<html>
    <head>
        <title>Ajouter une personne </title>
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
                return confirm("Etes vous sur de vouloir ajouter cette nouvelle personne ?");
            }
        </script>
        <?php
        /*************************************************************************
		Nom du script : AjouterUnePersonne.php
        Description :Ce script se connecte au SGBD MySQL,
                    envoie une requête pour ajouter les données rentrez dans le formulaiure
                    dans la table personne.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/

            if(isset($_POST["Valider"]))
            {
                //On recupere les données
                $AjouterNom = ($_POST['AjouterNom']);
                $AjouterPrenom = ($_POST['AjouterPrenom']);
                $AjouterVille = ($_POST['AjouterVille']);
                $AjouterEmail = $_POST['AjouterEmail'];

                //On asseptise les données
                $AjouterNom = sanitizeString($AjouterNom);
                $AjouterPrenom = sanitizeString($AjouterPrenom);
                $AjouterVille = sanitizeString($AjouterVille);
                $AjouterEmail = sanitizeString($AjouterEmail);

                //Données pour se connecter
                $Server = 'localhost';
                $Utilisateur = 'user2';
                $Motdepasse = 'snir@snir2019';
                $Base = 'projet';

                if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
                {
                    //Requête SQL
                    $reqInsert = "INSERT INTO personne (nom, prenom, ville, Email) VALUES ('$AjouterNom','$AjouterPrenom','$AjouterVille','$AjouterEmail')";
                    if ($result = mysqli_query($conn, $reqInsert, MYSQLI_USE_RESULT))
                    {
                        ?>
                        <div id="PourValiderSupprimer">
                            <?php
                            echo"La personne est bien enregistré !<br>";
                            echo"<a href='AfficherPersonnesAdmin.php'>Revenir sur la liste des personnes </a>";
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
        <table>
        <div id="PositionH1">
            <h1>Ajouter une personne </h1>
        </div>
        <div id="PositionAjouterModifierPersonne">
            <div>
                <label id="LabelAjouter" for="AjouterNom">Nom de la personne :</label>
                <input type="text" id="InputAjouter" name="AjouterNom" placeholder="Entrez un nom" required>
            </div>
            <div>
                <label id="LabelAjouter" for="AjouterPrenom">Prenom de la personne : </label>
                <input type="text" id="InputAjouter" name="AjouterPrenom" placeholder="Entrez le prenom" required>
            </div>
            <div>
                <label id="LabelAjouter" for="AjouterVille">Entrez la ville :</label>
                <input type="text" id="InputAjouter" name="AjouterVille" placeholder="Entrez une ville" required>
            <div>
                <label id="LabelAjouter"for="AjouterEmail">Entrez l'email de la personne :</label>
                <input type="email" id="InputAjouter" name="AjouterEmail" placeholder="Entrez l'email" required>
            </div>
            <div>
                <label id="LabelAjouter" for="Ajouter"></label>
                <input type="submit" id="InputAjouter" name="Valider" value="Valider">
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