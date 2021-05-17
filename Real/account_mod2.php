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
            
            
                $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
    
    $SQL= $dbco->prepare("UPDATE user Set username=?, prenom=?, nom=?, question=?, reponse=?, password=?, WHERE ");//WHERE $_POST['username']


    // One 's' for eatch string to modify
    //$--- are variables from the HTML/form
    //These values will replace the '?' in prepare function
    $SQL->bind_param('ssssss',$_POST['username'],$_POST['prenom'], $_POST['nom'], $_POST['question'], $_POST['reponse'], $_POST['password']);

    $account_update->execute();

  $message = "Modification Reussit";

  
   ?>
   <?php
    

?>
  <body>
    <div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
    <p>C'est votre tableau de bord.</p>
    <a href="logout.php">Déconnexion</a>
    <br>
    <a href="index.php">Retour</a>
    </div>
  <form id="username">
    Changer Pseudonyme: <input type="text" name="Pseudonyme_modify">
    <br>
  <form id="mot_de_passe">
    Changer Mot De Passe: <input type="text" name="Mot_de_passe_mod">
    <br>
  <form id="question">
    Changer Question secrète: <input type="text" name="question_mod">
    <br>
  <form id="answer">
     Changer Réponse à la question secrète: <input type="text" name="answer_Mod">
     <br>
    <input type="submit">
</form>
     
        
  </body>
</html>
    