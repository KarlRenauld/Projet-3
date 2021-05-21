
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="CSS/pageacteur.css" />
        <title>GBAF - Partenaires</title>
</head>
       
 
    <body>
 
<header> </header>  
 <div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
    <p>C'est votre tableau de bord.</p>
    <a href="logout.php">Déconnexion</a>
    <br>
    <a href="account_mod.php">Modifier Compte</a>
    </div>
<hr>
 
<?php
if (isset($_SESSION['username'])) {
$sessionusername = $_SESSION['username'];
$iduser = $_SESSION['id_user'];
$sessionprenom = $_SESSION['prenom'];
 
 
// on vérifie la variable pour voir si elle n'est pas vide et sécuriser un minimum avec htmlspecialchars
// is true if both isnt True
if (isset($_GET['id']) && !empty($_GET['id']))
 
{
    $id_acteur =htmlspecialchars($_GET['id']);
    //Récupération dans la base de donnée tous les articles
    $req="SELECT * FROM acteurs WHERE id_acteur =".$id_acteur."";
    $acteur = $bdd->prepare($req);
    $acteur ->execute();
 
   
 
   }
  
 
else
 
{
    die('Erreur');
}
 
while ($a = $acteur -> fetch())
{
    $idacteur=$_GET['id'];
    // Rajouter la valeur du dislikes dans le vote pour pouvoir différencier le likes et dislikes
    $req="SELECT vote FROM vote WHERE id_acteur = ".$idacteur." AND id_user = ".$iduser." AND vote=1 ";
    $likes= $bdd-> prepare($req);
    $likes->execute();
    $likes =$likes->rowCount(); // Compter le nombre de valeur que la requête nous retourne
  
 
// Rajouter la valeur du dislikes dans le vote pour pouvoir différencier le likes et dislikes
    $req2="SELECT vote FROM vote WHERE id_acteur = ".$idacteur." AND id_user =".$iduser." AND vote=2 ";
    $dislikes= $bdd-> prepare($req2);
    $dislikes->execute();
    $dislikes =$dislikes->rowCount(); // Compter le nombre de valeur que la requête nous retourne
  
 
   ?>
 
   
    <div id=logoActeur class="logoActeur">
        <? echo $a['logo'];?>
        <img src="Images/<?php echo $a['logo']; ?>" alt="Logo Acteur" title="" width="400px"/> </div>
   
        <div id="acteur" class="acteur">
         <h3> <?php echo $a['acteur'];?> : </h3>  </td> </div>
       
        <div id="description" class="description" >
 
        <?php $description = $a['description'];
        echo $a['description'];?></div>
 
 
<?php
   
}
?>
<br />
<hr>
<br />
<!-- Bouton nouveau commentaire -->
 
<div id="comm" name="comm">
<a href="post_commentaire.php?id=<?= $idacteur?>"><input type="submit" value="Nouveau Commentaire">
<br /> <br /> </div>
<!-- Création des boutons like/dislike
Faire un fichier php externe pour que ça soit plus lisible
like = 1 et dislike = 2-->
<div id="like" name="like">
<a href="action.php?t=1&id=<?= $idacteur?>"><img src="Images/like24px.png"></a> (<?= $likes ?>)
<a href="action.php?t=2&id=<?= $idacteur?>"><img src="Images/dislike24px.png"></a> (<?= $dislikes ?>)
</div>
<br/> <br/>
 
 
 
<!-- Création de l'espace commentaire -->
 
<h2> Commentaires :</h2>
 
<div id="commentaire" name="commentaire">
<?php
$acteur -> closeCursor();
 
//Compteur de commentaires
 
$req="SELECT post FROM post WHERE id_acteur =".$id_acteur."";
$Nombre_Comm =$bdd ->prepare($req);
$Nombre_Comm->execute();
$Nombre_Comm = $Nombre_Comm -> rowCount();
 
?>
<?php
//On récupère les commentaires, on écrit les commentaires, on affiche le nombre de commentaires qu'il y a. On affiche le nom/prénom sur chaque commentaire
// avec la date et l'heure et le texte et chaque commentaire doit être encadré
 
$req2= "SELECT *, DAY(date_add) AS jour, MONTH(date_add) AS mois, YEAR(date_add) AS annee FROM post WHERE id_acteur = ".$id_acteur." ORDER BY id_post DESC";
$commentaire = $bdd->prepare($req2);
$commentaire-> execute();
 
?>
 
<?php
 
while ($donnees = $commentaire-> fetch())
{
    $donnees['id_user'];
    $id_user=$donnees['id_user'];
  
    $req3 ="SELECT nom, prenom FROM account WHERE id_user = $id_user";
    $Nom_Prenom = $bdd-> prepare($req3);
    $Nom_Prenom -> execute();
    $donnees2 = $Nom_Prenom -> fetch();
 
    $Nom = $donnees2['nom'];
    $Prenom = $donnees2['prenom'];
    $date = date ("d-m-Y");
    ?>
    <p><strong><?php echo "$Nom " , "$Prenom" ; ?></strong>
    le <?php echo $date;?></p>
    <p><strong><?php echo ($donnees['post']);?></strong></p>
<?php
} // Fin de la boucle des commentaires
 
?>
<div id = "Nombre_Comm" name ="Nombre_Comm">
<?php echo 'Nombre de Commentaire : '.$Nombre_Comm. ''; ?>
</div>
<?php
$commentaire->closeCursor();
}
else {
    header('Location:index.php');
}
?>
</div>
 
 
 
        </body>
<footer> <?php include("footer.php") ?> </footer>
</html>
 