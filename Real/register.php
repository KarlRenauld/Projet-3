<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<?php 
require('config.php');
if (isset($_POST['username'], $_POST['prenom'], $_POST['password'], $_POST['nom'], $_POST['question'], $_POST['reponse']))
{  

    // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username); 
    // récupérer le prenom et supprimer les antislashes ajoutés par le formulaire
    $prenom = stripslashes($_POST['prenom']);
    $prenom = mysqli_real_escape_string($conn, $prenom);
    // récupérer le nom et supprimer les antislashes ajoutés par le formulaire
    $nom = stripslashes($_POST['nom']);
    $nom = mysqli_real_escape_string($conn, $nom);
    // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    // récupérer la question et supprimer les antislashes ajoutés par le formulaire
    $question = stripslashes($_POST['question']);
    $question = mysqli_real_escape_string($conn, $question);
    // récupérer la reponse et supprimer les antislashes ajoutés par le formulaire
    $reponse = stripslashes($_POST['reponse']);
    $reponse = mysqli_real_escape_string($conn, $reponse);

    //Regex  scheme =
    // At least one digit [0-9]
    //At least one lowercase character [a-z]
    //At least one uppercase character [A-Z]
    //At least 8 characters in length, but no more than 32.
    $password = $_POST['password'];

    if(!preg_match("^(?=.*[0-9])/(?=.*[a-z])(?=.*[A-Z]).{8,32}$^", $password))
    {
        echo "Mot de passe valide.";
    }
    else
    {
        echo "Mot de passe pas assez puissant.";
    }
    //Add Prepared statement once Account_mod.php done
    //requéte SQL + mot de passe crypté
    $query = "INSERT into `users` (username, prenom, nom, reponse, question, password)
              VALUES ('$username', '$prenom', '$nom', '$reponse','$question', '".hash('sha256', $password)."')";
    // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res)
    {
        echo "<div class='sucess'>
                <h3>Vous êtes inscrit avec succès.</h3>
                <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
        </div>";
    }
        ?>
<?php
    
}
?>
        <form class="box" action="" method="post">

            <h1 class="box-title">S'inscrire</h1>

            <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />

            <input type="text" class="box-input" name="nom" placeholder="Nom" required />

            <input type="text" class="box-input" name="prenom" placeholder="prenom" required />

            <input type="text" class="box-input" name="question" placeholder="Question Secrete" required />

            <input type="text" class="box-input" name="reponse" placeholder="Reponse Secrete" required />

            <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />

            <input type="submit" name="submit" value="S'inscrire" class="box-button" />

            <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
        </form>
        </body>
        </html>
 