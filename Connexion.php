<!DOCTYPE html>
<html>
    <head>
        <title>Connexion !</title>
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
		Nom du script : Connexion.php
        Description :Ce script se connecte avec les données pour la connexion ADMIN ou bien,
                    ce script se connecte au SGBD MySQL,
				    envoie une requête pour recuperrer les données
		    		de la table compte et affiche les droit clients .
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
			*************************************************************************/
        if (isset($_POST['Valider']))
        {
            // On récupere les données transmises pour la connexion
            $EmailConnexion = $_POST['EmailConnexion'];
            $MotDePasseConnexion = $_POST['MotDePasseConnexion'];
            $EmailConnexion = sanitizeString($EmailConnexion);
            $MotDePasseConnexion = sanitizeString($MotDePasseConnexion);
            //Pour les connexions ADMIN ()
            if($EmailConnexion == 'JonathanAdmin@Lycee.fr' && $MotDePasseConnexion == 'AdminJonathan' || $EmailConnexion == 'YannickAdmin@Lycee.fr' && $MotDePasseConnexion == 'AdminYannick')
            {
                ?><div id="PourValiderSupprimer"><?php
                echo "Vous êtes connecter en tant qu'admin !<br>";
                echo "<a href='PageBiblio.php'>Vos droit d'admin</a>"; 
                ?></div><?php 
            }
            //Pour les connexions clients
            else
            {
                // Paramètres de connexion 
                $Server = 'localhost';
                $Utilisateur = 'user2';
                $Motdepasse = 'snir@snir2019';
                $Base = 'projet';
                //tentative de connexion au SGBD MySQL 
                if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
                {
                    //Preparation de la rêquete
                    $reqSelect = "SELECT * FROM compte WHERE Email ='$EmailConnexion'";
                    // Envoie de la rêquete
                    if($result = mysqli_query($conn, $reqSelect))
                    {
                        $NbLignes = mysqli_num_rows($result);   
                        if($NbLignes == 1);
                        {
                            $row = mysqli_fetch_assoc($result);
                            //Crypter le mot de passe
                            $MotDePasse_Crypt_BD = $row['MotDePasse'];
                            //Si le mot de passe est OK 
                            if (password_verify($MotDePasseConnexion,$MotDePasse_Crypt_BD))
                            {
                                //On ouvre une session
                                session_start();
                                $_SESSION['EmailUser'] = $EmailConnexion;
                                ?><div id="PourValiderSupprimer">
                                <?php
                                echo "Vous êtes connecté en tant que client !<br>";
                                ?>
                                <form action="PageUtilisateur.php?Email=<?php echo $EmailConnexion;?>" method="post">
                                <a href="PageUtilisateur.php?Email=<?php echo $EmailConnexion;?>">Vos droit client !</a> 
                                </form>
                                <?php
                            }
                            else
                            {
                                ?><div id="PourValiderSupprimer"><?php
                                echo "Paramètres de connexion non valide !<br>";
                                echo '<a href="Connexion.php">Recommencez </a>';
                                ?></div><?php
                            }
                        }
                    }
                    else
                    {
                        //Erreur de rêquete
                        die("Erreur de rêquete"); 
                    }
                }
                else
                {
                    //Echec de connexion a la BD
                    die("Problême de connexion au serveur de base de données");
                }
            }    
        }         
            else
            {
                //Afficher le  formulaire
    ?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div id="PositionH1">
            <h1>Connexion environnement ! </h1>
        </div>
            <table>
                <div id="PositionInscriptionConnexion">
                    <div>
                        <label id="LabelConnexion" for="Email">Email : </label>
                        <input id="InputInscriptionConnexion" type="email" name="EmailConnexion" placeholder="Entrez votre email" required>
                    </div>
                    <div>
                        <label id="LabelConnexion" for="Mot De Passe">Mot de passe : </label>
                        <input id="InputInscriptionConnexion" type="password" name="MotDePasseConnexion" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <div>
                        <label id="LabelConnexion" for="Valider"></label>
                        <input id="InputInscriptionConnexion" type="submit" name="Valider" value="Valider">
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