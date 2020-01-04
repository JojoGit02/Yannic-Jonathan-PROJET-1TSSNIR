<!DOCTYPE html>
<html>
    <head>
        <title>Inscription</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Style.css">
    </head>
    <body>
    <header>
        <div id="BackgroundHead"><img src="LogoTop1.jpg" style="width:250px"/></div>
    </header>
    <!-- Menu deroulant -->
    <ul id="Menu_Deroulant">
        <li><a href="index.html">Accueil </a>
            <ul>
                <li><a href="Connexion.php">Se connecter</a></li>
                <li><a href="Inscription.php">Inscrivez vous maintenant</a></li>
            </ul>
        </li>
    </ul>
        <?php
        /*************************************************************************
		Nom du script : Inscription.php
        Description :Ce script se connecte au SGBD MySQL,
				    envoie une requête pour enregistrer les données
		    		dans la table compte pour permettre de se connecter.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/
        
        if (isset($_POST["Valider"]))
        {
            //On recupere les données
            $Email = utf8_decode($_POST['ZoneEmail']);
            $MotDePasse = $_POST['ZoneMotDePasse'];
            $ConfirmerMotDePasse = $_POST['ZoneConfirmerMotDePasse'];
            //Asseptiser les données
            $Email = sanitizeString($Email);
            $MotDePasse = sanitizeString($MotDePasse);
            $ConfirmerMotDePasse = sanitizeString($ConfirmerMotDePasse);

            if(empty($Email) || empty($MotDePasse) || $MotDePasse != $ConfirmerMotDePasse)
            {
                ?><div id="PourValiderSupprimer"><?php
                echo "Votre mot de passe n'est pas identique à celui de la confirmation <br>"; 
                echo '<a href="Inscription.php">Recommencer</a>' ;
                return;
                ?></div><?php
            }
            else
            {
                //Les données pour se connecter
                $Server = 'localhost';
                $Utilisateur = 'user2';
                $Motdepasse = 'snir@snir2019';
                $Base = 'projet';
                //On se connecte au MySQL
                if ($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
                {
                    // On hache le mot de passe
                    $MotDePasse_hash = password_hash($MotDePasse, PASSWORD_DEFAULT);

                    $reqInsert = " INSERT INTO compte (Email, MotDePasse)
                    VALUES ('$Email','$MotDePasse_hash')";
                    if($result = mysqli_query($conn, $reqInsert, MYSQLI_USE_RESULT))
                    {
                        ?><div id="PourValiderSupprimer">
                        <?php
                        echo "Votre compte a bien était crée !<br>";
                        echo "<a href=Connexion.php>Cliquer ici pour vous connecter !</a>"; 
                        ?></div><?php   
                    }
                    else
                    {
                        ?><div id="PourValiderSupprimer">
                        <?php
                        echo "Erreur d'inscription, cette email est déja utilisée !<br>";
                        echo "<a href='Inscription.php'>Recommencer</a>";
                        ?></div><?php
                    }
                }
                else
                {
                    die ("Probleme de connexion au serveur de base de données");
                }
            }
        }
        else
        {
             //Afficher le formulaire
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div id="PositionH1">
            <h1>Formulaire d'inscription</h1>
        </div>
            <table>
                <div id="PositionInscriptionConnexion">
                    <div>
                        <label id="LabelInscription" for="Identifiant">Votre Email :</label>
                        <input type="email" id="InputInscriptionConnexion" name="ZoneEmail" placeholder="Entrez votre email" required>
                    </div>
                    <div>
                        <label id="LabelInscription" for="MotDePasse">Votre mot de passe :</label>
                        <input type="password" id="InputInscriptionConnexion" name="ZoneMotDePasse" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <div>
                        <label id="LabelInscription" for="ConfirmationMotDePasse">Confirmer mot de passe : </label>
                        <input type="password" id="InputInscriptionConnexion" name="ZoneConfirmerMotDePasse" placeholder="Confirmer votre mot de passe" required>
                    </div>
                    <div>
                        <label id="LabelInscription" for="Valider"></label>
                        <input type="submit" id="InputInscriptionConnexion" name="Valider" value="Valider">
                    </div>
                </div>
            </table>
        </form>
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
    </body>
</html>