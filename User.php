<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $lastName = $_POST['lastname'];
    $firstName = $_POST['firstname'];
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $secretQuestion = $_POST['secret_question'];
    $answer = $_POST['answer'];
    //If stringlength is under 2 OR higher than 10 THEN Die
    if (strlen($lastName) < 2 || strlen($lastName) > 10) {
        echo '<p class="form-box"><a name="#resultat">Nom non valide.</a></p>';
        die();
      }
    if (strlen($firstName) < 2 || strlen($firstName) > 10) {
        echo '<p class="form-box"><a name="#resultat">Prenom non valide.</a></p>';
        die();
      }
     if (strlen($userName) < 2 || strlen($userName) > 10) {
        echo '<p class="form-box"><a name="#resultat">Utilisateur non valide.</a></p>';
        die();
      }
    if (strlen($password) < 3 || strlen($password) > 10 ) {
        echo '<p class="form-box"><a name="#resultat">Mot de passe non valide.</a></p>';
        die();
      }
    //Switch will choose the appropriate Case from the question
    switch($secretQuestion) {
        //If not(!)Null OR Under 3 char
        case 1:
          $secretQuestion = "Quelle est votre couleur préférée?";
          if (!isset($answer) || strlen($answer) < 3) {
            echo '<p class="form-box"><a name="#resultat">Réponse non valide.</a></p>';
          } die();
          
        break;
        case 2:
          $secretQuestion = "Quel est le nom de votre mère?";
          if (!isset($answer) || strlen($answer) < 3) {
            echo '<p class="form-box"><a name="#resultat">Réponse non valide.</a></p>';
            die();
          } 
         
        break;
        case 3:
          $secretQuestion = "Où se trouve votre ville natale?";
          if (!isset($answer) || strlen($answer) < 3) {
            echo '<p class="form-box"><a name="#resultat">Réponse non valide</a></p>';
            die();
          }

    }
  
  //$connection = Config.php
  $sql = $connection-> prepare("SELECT * FROM accounts WHERE username = ?");
  $sql-> execute([$_POST['username']]);
  //If Rowcount is higher than 0 then its allready taken
  if ($sql->rowCount() > 0) {
    echo '<p class="form-box"><a name="#resultat">Utilisateur Pris.</a></p>';  
    die();
  }
  
  //Sha1 is a Hashing term for passwords
 $password = sha1($password);
$insertinfo = $connection->prepare("INSERT INTO accounts (last_name, first_name, username, password, secret_question, answer) 
         VALUES ('$lastName', '$firstName', '$userName', '$password', '$secretQuestion', '$answer')");

  if ($insertinfo-> execute()) {
      echo '<p class="form-box"><a name="#resultat">Compte Valider.</a></p>';
   }
}
?>
