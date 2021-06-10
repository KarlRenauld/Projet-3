<?php
// "Mot de passe oublié?" a link to set new password
// pass all the info from this page to other pages:
  session_start();

  
  //if username and lastname and firstname is true then redirect
  if (isset($username) && isset($lastname) && isset($firstname)) {
    header("Location: ./index.php", true, 302);
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once('config.php');

    $req = $connection->prepare('SELECT last_name, first_name, username, password FROM accounts WHERE username=?');
    $req->execute([$_POST['username']]);
    //For later use
    $error = null;
    try {
      // If row count is equal 0 then its not valid
      if ($req->rowCount() == 0) {
        echo '<p class="form-box"><a name="#resultat">Utilisateur et Mot De Passe non valid.</a></p>';
      } else {
        
        $row = $req->fetch(PDO::FETCH_ASSOC);
        //If hashed Password not equal to $row password then
       if (!password_verify($_POST['password'], $row['password'])) {
           echo '<p class="form-box"><a name="#resultat">Mot de Passe non valid.</a></p>';
           
        } else {
           $_SESSION['lastname'] = $row['last_name'];
          $_SESSION['firstname'] = $row['first_name'];
          $_SESSION['username'] = $row['username'];
          
          //Redirection
          header("Location: ./index.php", true, 302);
          exit();
        }
      }
    } catch (Exception $e) {
      $error = $e->getMessage();
    }
  }
  
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
      <title>Login_page</title>
      <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
      <meta name="apple-mobile-web-app-capable" content="yes" />
    </head>
    <img class="head" id="head" src="images/logo_gbaf.png" alt="Logo_GBAF" >
    <form class="form-box"  method="POST">
      <h1>S'identifier:</h1>
      <h3>Nouveau salarié? &nbsp;<a href="inscription.php">S'inscrire</a></h3><br>
      <h4>Entrer votre nom d'utilisateur et votre mot de passe</h4><br>
      <link rel="stylesheet" type="text/css" href="CSS/footer.css">
      <link rel="stylesheet" type="text/css" href="CSS/login.css">
      <label for="username">Nom d'utilisateur: </label>
      <input type="text" name="username" id="username">
      <br>
      <label for="password">Mot de passe: </label>
      <input type="password" name="password" id="password"><br>
      <p><a href="forget_password.php">Mot de passe oublié?</a></p><br>
      <input type="submit" name="submit" value="S'identifier">
      <br>
      
    </form>
    <br><br><br><br><br><br>
      
<?php
include_once('footer.html');
?>
