<!DOCTYPE html>
<html>
    <head>
        <title>Ajouter un livre </title>
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
        <!-- Script pour demander si on veux ajouter ce livre -->
        <script type="text/javascript">
            function OnClickAjouter (){
                return confirm("Etes vous sur de vouloir ajouter ce nouveau livre ?");
            }
        </script>
        <?php
        /*************************************************************************
		Nom du script : AjouterUnLivre.php
        Description :Ce script se connecte au SGBD MySQL,
                    envoie une requête pour ajouter les données rentrez dans le formulaiure
                    dans la table livre.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/

            if(isset($_POST["Valider"]))
            {
                //On récupere les données
                $AjouterTitre = ($_POST['AjouterTitre']);
                $AjouterAuteur = ($_POST['AjouterAuteur']);
                $AjouterGenre = ($_POST['AjouterGenre']);
                $AjouterPrix = $_POST['AjouterPrix'];

                //On asseptise les données
                $AjouterTitre = sanitizeString($AjouterTitre);
                $AjouterAuteur = sanitizeString($AjouterAuteur);
                $AjouterGenre = sanitizeString($AjouterGenre);
                $AjouterPrix = sanitizeString($AjouterPrix);

                //Données pour se connecter
                $Server = 'localhost';
                $Utilisateur = 'user2';
                $Motdepasse = 'snir@snir2019';
                $Base = 'projet';
                if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
                {
                    //Requête SQL
                    $reqInsert = "INSERT INTO livre (titre,auteur,genre,prix) VALUES ('$AjouterTitre','$AjouterAuteur','$AjouterGenre','$AjouterPrix')";
                    if ($result = mysqli_query($conn, $reqInsert, MYSQLI_USE_RESULT))
                    { 
                    ?>
                    <div id="PourValiderSupprimer">
                        <?php
                        echo"Votre livre à était ajouté<br>";
                        echo"<a href='AfficherLivreAdmin.php'>Revenir sur la liste des livres </a>";
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
            <h1>Ajouter un livre </h1>
        </div>
        <div id="PositionAjouterModifierLivre">
            <div>
                <label for="AjouterTitre">Titre du livre :</label>
                <input type="text" name="AjouterTitre" placeholder="Entrez un titre" required>
            </div>
            <div>
                <label for="AjouterAuteur">Auteur du livre : </label>
                <input type="text" name="AjouterAuteur" placeholder="Entrez le nom de l'auteur :" required>
            </div>
            <div>
                <label for="AjouterGenre">Genre du livre :</label>
                <select name="AjouterGenre">
                    <option value="Roman">Roman</option>
                    <option value="Poesie">Poésie</option>
                    <option value="Nouvelle">Nouvelle</option>
                    <option value="BD">BD</option>
                </select>
            <div>
                <label for="Prix">Prix du livre :</label>
                <input type="number" name="AjouterPrix" placeholder="Entrez le prix en euros" required>
            </div>
            <div>
                <label for="Valider"></label>
                <input type="submit" name="Valider" value="Valider">
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
        <div>
            <a href="PageBiblio.php">
                <img src="RetourAccueil.PNG" style="width:160px"/>
            </a>
        </div>
    </body>
</html>