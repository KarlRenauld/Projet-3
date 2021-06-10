<?php

include('config.php');
?>
  <!DOCTYPE html>
  <html lang="fr">
  <head>
    <title>Inscription</title>
  </head>
  <body>
  
  
  <link rel="stylesheet" type="text/css" href="CSS/footer.css">
  <link rel="stylesheet" type="text/css" href="CSS/login.css">
  <img class="head"  src="images/logo_gbaf.png" alt="logo_gbaf" >
  <form class="form-box"  method="POST">
    <h1>Bienvenue:</h1>
    <h3>Déjà salarié? <a href="login.php">S'identifier</a></h3><br>

    <label for="lastname">Nom(Entre 2 à 10 charactères): </label><input type="text" name="lastname" placeholder="Entrer votre nom" id="lastname"><br>
    <label for="firstname">Prénom(Entre 2 à 10 charactères): </label><input type="text" name="firstname" placeholder="Entrer votre prénom" id='firstname'><br>
    <label for="username">Nom d'utilisateur(Entre 2 à 10 charactères): </label><input type="text" name="username" placeholder="Entrer votre username" id='username'><br>

    <label for="password">Mot de passe(Entre 3 à 10 charactères): </label><input type="password" name="password" placeholder="Entrer votre mot de passe" id='password'><br>
    <label for="secret_question">Choisir une question secrete: </label>

    <select name="secret_question" id="secret_question">
      <option value="">--Choisir une option--</option>
      <option value="1">Quelle est votre couleur préférée?</option>
      <option value="2">Quel est le nom de votre mère?</option>
      <option value="3">Où se trouve votre ville natale?</option>  
    </select><br>

    <label for="answer">Votre réponse(Plus que 2 charactères): </label><input type="text" name="answer" placeholder="Entrer votre réponse" id="answer"><br>
    <input type="submit" name="submit" value="S'inscrire" >
  </form><br><br><br><br><br><br><br><br><br>
<?php  
  include('User.php');
  include('footer.html');  
?>
