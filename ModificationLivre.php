<!DOCTYPE html>
<html>
    <head>
        <title>Modifier livre</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Style.css">
    </head>
    <body>
    <header>
        <div id="BackgroundHead"><img src="LogoTop1.jpg" style="width:250px"/></div>
    </header>
    <!-------------------------------- Menu deroulant ------------------------------->
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
    </ul>>
    <!-------------------------- Fin menu deroulant ------------------------->
        <?php
    	/*************************************************************************
		Nom du script : ModificationLivre.php.php
        Description :ce script récupere le numero du livre pour pouvoir le modifier, se connecte au SGBD MySQL,
				    envoie une requête pour recuperer les modification et les enregistres
		    		dans la table livre .
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/
        
        //On récupere la valeur de numlivre
        $numlivre = $_GET["numlivre"];
        //Données pour se connecter
        $Server = 'localhost';
        $Utilisateur = 'user2';
        $Motdepasse = 'snir@snir2019';
        $Base = 'projet';
        if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
        {
            //Requête SQL
            $reqSelect = "Select * FROM livre where numlivre =".$numlivre;
            if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    //On récupere les valeurs de la table livre
                    $numlivre = $row['numlivre'];
                    $titre = utf8_encode ($row['titre']);
                    $auteur = utf8_encode ($row['auteur']);
                    $genre = utf8_encode ($row['genre']);
                    $prix = $row['prix'];
                }
            }
        }
        //Appuyer sur Modifier
        if(isset($_POST['Modifier']))
        {
            //On recupére les valeurs 
            $NewTitre = ($_POST['NewTitre']);
            $NewAuteur = ($_POST['NewAuteur']);
            $NewGenre = ($_POST['NewGenre']);
            $NewPrix = $_POST['NewPrix'];

            //On asseptise les données
            $NewTitre = sanitizeString($NewTitre);
            $NewAuteur = sanitizeString($NewAuteur);
            $NewGenre = sanitizeString($NewGenre);
            $NewPrix = sanitizeString($NewPrix);

            //On se connecte au Mysql
            $Server = 'localhost';
            $Utilisateur = 'user2';
            $Motdepasse = 'snir@snir2019';
            $Base = 'projet';
            if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
            {
                //Requête SQL pour Modifier
                $reqUdpate = "UPDATE livre SET 
                    titre ='$NewTitre', 
                    auteur='$NewAuteur',
                    genre='$NewGenre',
                    prix='$NewPrix' 
                    WHERE numlivre = $numlivre";  
                    //On Modifier les valeurs
                    if($result = mysqli_query($conn, $reqUdpate, MYSQLI_USE_RESULT))
                    {
                    ?>
                    <div id="PourValiderSupprimer">
                    <?php
                        //On écrit que le livre a était modifier
                        echo "Le livre a était Modifier<br> ";
                        echo"<a href='AfficherLivreAdmin.php'>Revenir sur la page des livres </a>";                
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
                return confirm("Etes vous sûr de vouloir modifier ce livre ?");
            }
        </script>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return OnClickModifier();">
        <div id="PositionH1">
            <h1>Modifier le livre <?php echo $numlivre?></h1>
        </div>
        <div id="PositionAjouterModifierLivre">
            <div>
                <label for="NewTitre">Modifier titre :</label> 
                <input type="text" name="NewTitre" value= "<?php echo $titre ?>">  
            </div>

            <div>
                <label for="NewAuteur">Modifier l' auteur :</label>
                <input type="text" name="NewAuteur" value="<?php echo $auteur?>">
            </div>

            <div>
            <label for="NewGenre">Modifier le genre</label>
            <select name="NewGenre">
                <?php
                $Server = 'localhost';
                $Utilisateur = 'user2';
                $Motdepasse = 'snir@snir2019';
                $Base = 'projet';
                if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
                {
                    $reqSelect = "SELECT genre FROM livre WHERE numlivre =".$numlivre;
                    if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
                {   
                    if($genre=='Roman')
                    {
                        echo "
                        <option value='Roman'>$genre</option>     
                        <option value='Poesie'>Poesie</option>
                        <option value='Nouvelle'>Nouvelle</option>
                        <option value='Bd'>Bd</option>";
                    }
                    if($genre=='Poesie')
                    {
                        echo "
                        <option value='Poesie'>$genre</option>
                        <option value='Roman'>Roman</option>
                        <option value='Nouvelle'>Nouvelle</option>
                        <option value='Bd'>Bd</option>";
                    }
                    if($genre=='Nouvelle')
                    {
                        echo "
                        <option value='Nouvelle'>$genre</option>
                        <option value='Roman'>Roman</option>
                        <option value='Poesie'>Poesie</option>
                        <option value='Bd'>Bd</option>";
                    }
                    if($genre=='Bd')
                    {
                        echo "
                        <option value='Bd'>$genre</option>
                        <option value='Roman'>Roman</option>
                        <option value='Poesie'>Poesie</option>
                        <option value='Nouvelle'>Nouvelle</option>";
                    }
                }
            }
                ?>
            </select>
            </div>

            <div>
                <label for="NewPrix">Modifier le prix : </label>
                <input type="number" name="NewPrix" value="<?php echo $prix?>">
            </div>
        
            <div>
                <label for="Modifier"></label>
                <input type="submit" name="Modifier" value="Valider">   
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
        <div>
            <a href="PageBiblio.php">
                <img src="RetourAccueil.PNG" style="width:160px"/>
            </a>
        </div>
    </body>
</html>