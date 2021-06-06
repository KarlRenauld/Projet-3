<?php
// "Mot de passe oublié?" a link to set new password
// pass all the info from this page to other pages:
  session_start();

  
  //if username and lastname and firstname is true then redirect
  if (isset($username) && isset($lastname) && isset($firstname)) {
    //header(302) = Redirection
    header("Location: ./index.php", true, 302);
    exit();
  }
  //If request method = POST then run code
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once('config.php');
  
    $req = $connection->prepare('SELECT last_name, first_name, username, password FROM accounts WHERE username=?');
    $req->execute([$_POST['username']]);
    // Create variable $error for later use
    $error = null;
   try {
      if ($req->rowCount() == 0) {
        throw new Exception("Username/mot de passe non valide");
      } else {
        
        $row = $req->fetch(PDO::FETCH_ASSOC);
        // if Post password is not = to $row password then error
        if (!sha1($_POST['password'], $row['password'])) {
          throw new Exception("Mot de passe incorrect");
        } else {
          $_SESSION['lastname'] = $row['last_name'];
          $_SESSION['firstname'] = $row['first_name'];
          $_SESSION['username'] = $row['username'];

          
          header("Location: ./index.php", true, 302);
          exit();
        }
      }

    }
     //getMessage = Exeption (getMessage)
     catch (Exception $e) {
      $error = $e->getMessage();
     }
  }
  
?>
    <img class="head" name="head" src="images/logo_gbaf.png" >
    <form class="form-box" action="" method="POST">
      
      <body>
      <h1>S'identifier:</h1>
      <h3>Nouveau salarié? &nbsp;<a href="inscription.php">S'inscrire</a></h3><br>
      <h4>Entrer votre nom d'utilisateur et votre mot de passe</h4><br>
      
      <link rel="stylesheet" type="text/css" href="CSS/login.css">
      <label for="username">Nom d'utilisateur: </label>
      <input type="text" name="username">
      <br>
      <label for="password">Mot de passe: </label>
      <input type="password" name="password"><br>
      <p><a href="forget_password.php">Mot de passe oublié?</a></p><br>
      <input type="submit" name="submit" value="S'identifier">
      <br>
      </body>
    </form><br><br><br><br><br><br>
      
<?php
include_once('footer.html');
?>