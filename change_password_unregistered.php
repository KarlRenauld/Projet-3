<?php

session_start();

$username;
$secretQuestion;
$answer;
if (isset($_SESSION['username'])) $username = $_SESSION['username'];
if (isset($_SESSION['secret_question'])) $secretQuestion = $_SESSION['secret_question'];
if (isset($_SESSION['answer'])) $answer = $_SESSION['answer'];

if (!isset($username) || !isset($secretQuestion) || !isset($answer)) {
  header("Location: ./login.php", true, 302);
  exit();
}

include_once('config.php');

// Find id of the user:
$req = $connection->prepare('SELECT * FROM accounts WHERE username=? AND secret_question=? AND answer=?');

$req-> execute([$username, $secretQuestion, $answer]);

$row = $req->fetch(PDO::FETCH_ASSOC);
// print_r($row);
// Update all for this user:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['recover'])) {

    $error = null;
    try {
      

      if (strlen($_POST['username']) < 2 || strlen($_POST['username']) > 10) {
        throw new Exception("Username non valide");
      }
      $newUserName = $_POST['username'];

      if (strlen($_POST['password']) < 3 || strlen($_POST['password']) > 10) {
        throw new Exception("Mot de passe non valide");
      }
      $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $newSecretQuestion = $_POST['secret_question'];
      $newAnswer = $_POST['answer'];

      $modify = $connection->prepare('UPDATE accounts SET  username=?, password=? WHERE id=? ');
      $modify->execute([$_POST['username'], $newPassword, $row['id']]);
      header("Location: ./login.php", true, 302);
      exit();
    } catch (Exception $e) {
      $error = $e->getMessage() . '<br>';
    }
  }
}

?>
  <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <img class="head" name="head" src="images/logo_gbaf.png" >
  <form class="form-box" action="" method="POST">
    <h1>Ajouter un nouveau mot de passe:</h1>
   

    <?php
        if (isset($error)) {
          echo '<div class="alert-danger" role="alert">' . $error . '</div><br>';
        }
    ?>

   
    <label for="username">Nouveau nom d'utilisateur(Entre 2 à 10 charactères): </label><input type="text" name="username" value="<?php if(isset($username)) echo $username; ?>"><br>

    <label for="password">Nouveau mot de passe(Entre 3 à 10 charactères): </label><input type="password" name="password"><br>

   
    <input type="submit" name="recover" value="Enregistrer">
  </form><br><br><br><br>
<?php
include_once('footer.html');
?>
