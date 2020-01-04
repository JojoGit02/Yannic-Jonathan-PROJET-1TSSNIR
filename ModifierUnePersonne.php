<!DOCTYPE html>
<html>
    <head>
        <title>Modifier personne</title>
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
    <!------------------------------------ Fin menu deroulanbt ----------------------->
        <?php
    	/*************************************************************************
		Nom du script : ModifierUnePersonne.php
        Description :Ce script récupere les données de la personne qu'on veux modifier puis se connecte au SGBD MySQL,
				    envoie une requête pour enregistrer les données modifier
		    		de la table personne.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
			*************************************************************************/

        //On récupere la valeur de numlivre
        $numpersonne = $_GET["numpersonne"];
        //Données pour se connecter
        $Server = 'localhost';
        $Utilisateur = 'user2';
        $Motdepasse = 'snir@snir2019';
        $Base = 'projet';
        if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
        {
            $reqSelect = "Select * FROM personne where numpersonne =".$numpersonne;
            if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    //On récuper les données de la table personne
                    $numpersonne = $row['numpersonne'];
                    $Nom = utf8_encode ($row['nom']);
                    $Prenom = utf8_encode ($row['prenom']);
                    $Ville = utf8_encode ($row['ville']);
                    $Email = $row['Email'];
                }
            }
        }
        //Appuyer sur Modifier
        if(isset($_POST['Modifier']))
        {
            //On recupére les valeurs 
            $NewNom = ($_POST['NewNom']);
            $NewPrenom = ($_POST['NewPrenom']);
            $NewVille = ($_POST['NewVille']);
            $NewEmail = $_POST['NewEmail'];

            //On asseptise les données
            $NewNom = sanitizeString($NewNom);
            $NewPrenom = sanitizeString($NewPrenom);
            $NewVille = sanitizeString($NewVille);
            $NewEmail = sanitizeString($NewEmail);

            //On se connecte au Mysql
            $Server = 'localhost';
            $Utilisateur = 'user2';
            $Motdepasse = 'snir@snir2019';
            $Base = 'projet';
            if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
            {
                //Requête pour Modifier
                $reqUdpate = "UPDATE personne SET 
                    nom ='$NewNom', 
                    prenom='$NewPrenom',
                    ville='$NewVille',
                    Email='$NewEmail' 
                    WHERE numpersonne = $numpersonne";  
                    //On Modifier les valeurs
                    if($result = mysqli_query($conn, $reqUdpate, MYSQLI_USE_RESULT))
                    {
                        ?>
                        <div id="PourValiderSupprimer">
                            <?php
                            //On écrit que le livre a était modifier
                            echo "La personne a était Modifier<br> ";
                            echo"<a href='AfficherPersonnesAdmin.php'>Revenir sur la page des personnes </a>"; 
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
            //Afficher le formulaire
        ?>
        <script type="text/javascript">
            function OnClickModifier(){
                return confirm("Etes vous sûr de vouloir modifier cette personne ?");
            }
        </script>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return OnClickModifier();">
        <div id="PositionH1">
            <h1>Modifier la personne <?php echo $numpersonne?></h1>
        </div>
        <div id="PositionAjouterModifierPersonne">
            <div>
                <label id="LabelAjouter" for="NewNom">Modifier le nom :</label> 
                <input type="text" id="InputAjouter" name="NewNom" value= "<?php echo $Nom ?>">  
            </div>

            <div>
                <label id="LabelAjouter" for="NewPrenom">Modifier le prenom :</label>
                <input type="text" id="InputAjouter" name="NewPrenom" value="<?php echo $Prenom?>">
            </div>

            <div>
                <label id="LabelAjouter" for="NewVille">Modifier la ville :</label>
                <input type="text" id="InputAjouter" name="NewVille" value="<?php echo $Ville?>">
            </div>

            <div>
                <label  id="LabelAjouter" for="NewEmail">Modifier l'email : </label>
                <input type="email" id="InputAjouter" name="NewEmail" value="<?php echo $Email?>">
            </div>
        
            <div>
                <label id="LabelAjouter" for="Ajouter"></label>
                <input type="submit" id="InputAjouter" name="Modifier" value="Valider">   
            </div>
        </div>
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
        <!-- Bouton pour retourner à la page d'accueil -->
        <div>
            <a href="PageBiblio.php">
                <img src="RetourAccueil.PNG" style="width:160px"/>
            </a>
        </div>
    </body>
</html>