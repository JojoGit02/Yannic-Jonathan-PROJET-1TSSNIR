<!DOCTYPE html>
<html>
    <head>
        <title>Page bibliothécaire !</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Style.css">
    </head>
    <body>
    <!-----------------------------------------------
    Nom du script : PageBiblio.php
        Description :Ce script affiche les fonctionnalités pour la page administrateur(Bibliothécaire)
		Version : 1.0
		Date	: 04/01/2020
        Auteur	: Di Martino,Pascucci 
        --------------------------------------------->

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
    <!---- Fin menu deroulant --->

        <div id="PositionH1">
        <h1>Bonjour, vous étes connecté en tant qu'administrateur</h1>
        </div>
        <div id="PositionPageDebut">
            <table>
                <div>
                    <a href="AfficherLivreAdmin.php">Afficher les livres </a> <br>
                    <a href="AfficherPersonnesAdmin.php">Afficher les personnes</a><br>
                    <a href="AfficherEmpruntAdmin.php">Afficher les emprunt</a><br>
                </div>
            </table>
            <div>
                <script> function OnClickDeco(){
                    return confirm("Êtes vous sûr de vouloir vous deconnecter ?");
                }
                </script>
                <form action="index.html" method="post" onsubmit="return OnClickDeco();">
                    <input type="submit" name="SeDeconnecter" value="Se déconnecter">
                </form>
            </div>
        </div>
    </body>
</html>
