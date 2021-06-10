<?php
session_start();
// Verify the username and the secret question:

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['recover'])) {
    $error = null;
    try {
      //if username is not valid (||) or string lengh more than, then
      if (!isset($_POST['username']) || strlen($_POST['username']) < 2 ){
        throw new Exception("Username non valide");
        // if secret_question is not valid or string lengh more than, then
      } else if (!isset($_POST['secret_question']) || strlen(($_POST['answer'])) < 3) {
        throw new Exception("Question secrète ou réponse non valide");
      } else {
        include_once('config.php');
        //Limit only brings 1
        $req = $connection->prepare('SELECT * FROM accounts WHERE username=? AND secret_question=? AND answer=? LIMIT 1');
        $req->execute([$_POST['username'], $_POST['secret_question'], $_POST['answer']]);
        // if rowcount = exactly 0, then 
        if ($req->rowCount() == 0) {
          throw new Exception("Nom d'utilisateur ou question secrète/réponse incorrect");
        } 
          else {
          $row = $req->fetch(PDO::FETCH_ASSOC);
           print_r($row);
          //if everything matches 
          if ($_POST['username'] == $row['username'] && $_POST['secret_question'] == $row['secret_question'] && $_POST['answer'] == $row['answer']) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['secret_question'] = $row['secret_question'];
            $_SESSION['answer'] = $row['answer'];
            header("Location: ./change_password_unregistered.php", true, 302);
            exit();
          }
        }
      }
    } catch (Exception $e) {
      $error = $e->getMessage() . '<br>';
    }
  }
}

?>
  <!DOCTYPE html>
  <html lang="fr">
  <head>
    <title>Mot de Passe Oublier</title>
    <link rel="stylesheet" type="text/css" href="CSS/footer.css">
  <link rel="stylesheet" type="text/css" href="CSS/forget_password.css">
  </head>
 
  
  <img class="head"  src="images/logo_gbaf.png" alt="logo_gbaf" >
  
  <form id="head" class="form-box"  method="POST">
    <h2>Récupérer votre compte avec la question secrète:</h2><br>
    <?php
        if (isset($error)) {
          echo '<div class="alert-danger" role="alert">' . $error . '</div><br>';
        }
    ?>
    <label for="username">Nom d'utilisateur:</label><input type="text" name="username" id="username">
    <br>
    <label for="secret_question">Choisir la question secrète que vous avez enregistré: </label>
    <select name="secret_question" id="secret_question">
      <option value="">--Choisir une option--</option>
      <option value="Quelle est votre couleur préférée?">Quelle est votre couleur préférée?</option>
      <option value="Quel est le nom de votre mère?">Quel est le nom de votre mère?</option>
      <option value="Où se trouve votre ville natale?">Où se trouve votre ville natale?</option>
    </select><br>
    <label for="answer">Votre réponse que vous avez enregistrée: </label><input type="text" name="answer" placeholder="Entrer votre réponse" id="answer"><br>
    <input type="submit" name="recover" value="Récupérer Mon Compte">
  </form>
  </body>
<?php

?>