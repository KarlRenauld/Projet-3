<?php

include('config.php');
?>
  <link rel="stylesheet" type="text/css" href="CSS/login.css">
  <img class="head" name="head" src="images/logo_gbaf.png" >
  <form class="form-box" action="" method="POST">
    <h1>Bienvenue:</h1>
    <h3>Déjà salarié? <a href="login.php">S'identifier</a></h3><br>

    <label for="lastname">Nom(Entre 2 à 10 charactères): </label><input type="text" name="lastname" placeholder="Entrer votre nom"><br>
    <label for="firstname">Prénom(Entre 2 à 10 charactères): </label><input type="text" name="firstname" placeholder="Entrer votre prénom"><br>
    <label for="username">Nom d'utilisateur(Entre 2 à 10 charactères): </label><input type="text" name="username" placeholder="Entrer votre username"><br>

    <label for="password">Mot de passe(Entre 3 à 10 charactères): </label><input type="password" name="password" placeholder="Entrer votre mot de passe"><br>
    <label for="secret_question">Choisir une question secrete: </label>

    <select name="secret_question" id="secret_question">
      <option value="">--Choisir une option--</option>
      <option value="1">Quelle est votre couleur préférée?</option>
      <option value="2">Quel est le nom de votre mère?</option>
      <option value="3">Où se trouve votre ville natale?</option>  
    </select><br>

    <label for="answer">Votre réponse(Plus que 2 charactères): </label><input type="text" name="answer" placeholder="Entrer votre réponse"><br>
    <input type="submit" name="submit" value="S'inscrire" >
  </form>
<?php  
  include('User.php');
  include('footer.html');  
?>

