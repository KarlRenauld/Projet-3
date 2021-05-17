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

  <?php 
    $servname = "localhost"; $dbname = "extranet"; $user = "root"; $pass = "";
            
              try{
                $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
                // set the PDO error mode to exception
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              //$_Post has not loaded since the form has not yet run?

              //Prepare to bind 
               $SQL= $dbco->prepare("UPDATE users Set username=?,question=?, reponse=?, password=?, WHERE  ");
               //WHERE $_SESSION['username']??.


                // One 's' for each string to modify
                //$--- are variables from the HTML/form
                 //These values will replace the '?' in prepare function
                 $SQL->bindparam('ssss',$_POST['username'], $_POST['question'], $_POST['answer'], $_POST['password']);

                $SQL->execute();

                $message = "Modification Reussit";
              }
  //catch exception
  catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();

  
   ?>
   <?php
  }

  ?>
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

            <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />

            <input type="text" class="box-input" name="nom" placeholder="Nom" required />

            <input type="text" class="box-input" name="prenom" placeholder="prenom" required />

            <input type="text" class="box-input" name="question" placeholder="Question Secrete" required />

            <input type="text" class="box-input" name="reponse" placeholder="Reponse Secrete" required />

            <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />

            <input type="submit" name="submit" value="Valider Modification" class="box-button" />
        </form>
     
        
  </body>
</html>
    