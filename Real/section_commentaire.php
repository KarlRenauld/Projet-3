<?php
  // Start a session
  session_start();
  // Verify if user is connected, if not, redirect to Login page
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formation&Co</title>
</head>
<body>

 <div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
    <p></p>
    <a href="logout.php">Déconnexion</a>
    <br>
    <a href="account_mod.php">Modifier Compte</a>
    </div>

    <div id=logoActeur class="logoActeur">
    	<br>    
        <img src='Images/formation_co.png'  alt= 'Logo Acteur'; title='' width="400px"/> </div>
     <?php
       $servername = 'localhost';
       $username = 'root';
       $password = '';
       $dbname = 'extranet'; 
       //create connection
       $conn = new mysqli($servername,$username,$password,$dbname);
       //check connection
       if ($conn->connect_error) {
        die('connection failed' . $conn->connect_error);
       }


       //---------------//

        $sql = 'SELECT acteur, description FROM acteurs WHERE Id_acteur = 1';
       $result = $conn-> query($sql);

       if ($result->num_rows > 0) {
        //show data
        while ($row = $result -> fetch_assoc()) {
            echo "Acteur: " .$row['acteur']. '<br><br>',  "Description: " .$row['description']. '<br>' ;
  }

        }
          
       
       ?>
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
?>
</body>
</html>