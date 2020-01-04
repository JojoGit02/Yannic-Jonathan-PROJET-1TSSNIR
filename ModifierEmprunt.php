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
    <!---------------------------------- Menu deroulant -------------------------------->
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
    <!---------------------------------- Fin menu deroulant -------------------------->
        <?php
    	/*************************************************************************
		Nom du script : ModifierEmprunt.php
        Description :Ce script récupere les données d'un emprunt pour pouvoir le modifier
                    se connecte au SGBD MySQL,
				    envoie une requête pour recuperrer les données modifier
		    		de la table emprunt.
		Version : 1.0
		Date	: 04/01/2020
		Auteur	: Di Martino,Pascucci 
            *************************************************************************/
            
        //On récupere la valeur de numlivre
        $numpersonne = $_GET["numpersonne"];
        $numlivre = $_GET["numlivre"];
        $Server = 'localhost';
        $Utilisateur = 'user2';
        $Motdepasse = 'snir@snir2019';
        $Base = 'projet';
        if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
        {
            $reqSelect = "Select * FROM emprunt where numpersonne =$numpersonne AND numlivre=".$numlivre;
            if($result = mysqli_query($conn, $reqSelect, MYSQLI_USE_RESULT))
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $numpersonne = $row['numpersonne'];
                    $numlivre = ($row['numlivre']);
                    $dateSortie = ($row['dateSortie']);
                    $dateRetour = ($row['dateRetour']);
                }
            }
        }
        //Appuyer sur Modifier
        if(isset($_POST['Modifier']))
        {
            //On recupére les valeurs 
            $NewNumPersonne = ($_POST['NewNumPersonne']);
            $NewNumLivre = ($_POST['NewNumLivre']);
            $NewDateSortie = utf8_decode($_POST['NewDateSortie']);
            $NewDateRetour = $_POST['NewDateRetour'];

            //On se connecte au Mysql
            $Server = 'localhost';
            $Utilisateur = 'user2';
            $Motdepasse = 'snir@snir2019';
            $Base = 'projet';
            if($conn = mysqli_connect($Server,$Utilisateur,$Motdepasse,$Base))
            {
                //Requête pour Modifier
                $reqUdpate = "UPDATE emprunt SET 
                    numpersonne ='$NewNumPersonne', 
                    numlivre='$NewNumLivre',
                    dateSortie='$NewDateSortie',
                    dateRetour='$NewDateRetour' 
                    WHERE numpersonne = $numpersonne AND numlivre=$numlivre";  
                    //On Modifier les valeurs
                    if($result = mysqli_query($conn, $reqUdpate, MYSQLI_USE_RESULT))
                    {
                        ?>
                        <div id="PourValiderSupprimer">
                            <?php
                            //On écrit que le livre a était modifier
                            echo "L'emprunt a était Modifier<br> ";
                            echo"<a href='AfficherEmpruntAdmin.php'>Revenir sur la page des emprunts </a>";                
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
                return confirm("Etes vous sûr de vouloir modifier cette emprunt ?");
            }
        </script>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return OnClickModifier();">
        <div id="PositionH1">
            <h1>Modifier l'emprunt</h1>
        </div>
        <div id="PositionAjouterModifierEmprunt">
            <div>
                <label id="LabelModifierEmprunt" for="NewNumPersonne">Modifier le numpersonne :</label> 
                <input type="number" id="InputModifierEmprunt" name="NewNumPersonne" value= "<?php echo $numpersonne?>">  
            </div>

            <div>
                <label id="LabelModifierEmprunt" for="NewNumLivre">Modifier le numlivre :</label>
                <input type="number" id="InputModifierEmprunt"name="NewNumLivre" value="<?php echo $numlivre?>">
            </div>

            <div>
                <label id="LabelModifierEmprunt" for="NewDateSortie">Modifier la date de sortie :</label>
                <input type="date" id="InputModifierEmprunt" name="NewDateSortie" value="<?php echo $dateSortie?>">
            </div>

            <div>
                <label id="LabelModifierEmprunt" for="NewDateRetour">Modifier la date de retour : </label>
                <input type="date" id="InputModifierEmprunt" name="NewDateRetour" value="<?php
                if($dateRetour == NULL)
                {
                    echo "0000/00/00";
                }
                if($dateRetour == $dateRetour)
                {
                    echo $dateRetour;
                }
                    ?>">
            </div>
        
            <div>
                <label id="LabelModifierEmprunt" for="Valider"></label>
                <input type="submit" id="InputModifierEmprunt" name="Modifier" value="Valider">  
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