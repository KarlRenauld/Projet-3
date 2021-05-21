<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecte, sinon redirection vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
    <p>C'est votre tableau de bord.</p>
    <a href="logout.php">Déconnexion</a>
    <br>
    <a href="index.php">Retour</a>
    </div>
   <form class="box" action="" method="post">

            <h1 class="box-title">Modifier Compte</h1>

            <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" id="username"  />

            <input type="text" class="box-input" name="question" placeholder="Question Secrete" id="question"  />

            <input type="text" class="box-input" name="reponse" id="reponse" placeholder="Reponse Secrete"  />

            <input type="password" class="box-input" name="password" placeholder="Mot de passe" id="password"  />

            <input type="password" class="box-input" name="password" placeholder=" Confirmation du mot de passe" id="password2"  />

            <input type="submit" name="submit" value="Valider Modification" class="box-button" />
        </form>

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
       
       //USername modification section
       

       //Password modification section
       $req = "SELECT * FROM users WHERE username = ".$_SESSION['username']."";
        $requser = $conn -> prepare($req);

        if (isset($_POST['password']) && isset($_POST['password2']) AND !empty($_POST['password']) AND !empty($_POST['password2']))
{
 
        if ($_POST['password'] == $_POST['password2'])
     {
        echo $_POST['password'];
    $remplace_MDP = password_hash($_POST['password']);
    $ModificationMDP= "UPDATE users SET password='" . $remplace_MDP . "' WHERE username='" . $_SESSION['username'] . "'; ";
    $resultat=$bdd->prepare($ModificationMDP);
    $resultat->execute();
   
    echo "Votre MDP a été changé";
 
        }
        else
        {
                $msg = "Vos deux mots de passe ne correspondent pas !";
        }
       
      
}


        
       
        


  ?>
 
     
        
  </body>
</html>