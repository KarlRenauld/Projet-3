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
<? include("config.php");?>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="CSS/modificationcompte.css" />
        <title>GBAF - Modification du Compte</title>
</head>
       
 
    <body>
    <p>
    <form method="POST" action="">
 
    <p>
    <div id=compte name=compte>
    <form method="POST" action="">
 
            <h3>Modification du compte : <br /> <br /></h3>
       
        
 
        <label for="username"> Nom d'Utilisateur : <?php echo $_SESSION['username']; ?> </br> <br /> </label>
 
        <label for="new_username"> Nouveau Pseudo : </label>
        <input type="new_username" name="new_username" id="new_username"/></p>
 
       
        <label for="remplace_MDP"> Nouveau mot de passe :</label>
        <input type="Password" name="remplace_MDP" id="remplace_MDP"></p>
 
        <label for="mdp2"> Confirmer le nouveau Mot de Passe : </label>
        <input type="Password" name="mdp2" id="mdp2" /></p>
 
        <label for ="New_question"> Changer la question secrète : </label>
        <select name="New_question" id="New_question" >
            <option value="1">Où habitiez vous quand vous étiez petit ?</option>
            <option value="2">Le nom de jeune fille de votre mère ?</option>
            <option value="3">Le nom de votre premier animal</option>
           
        </select> <br/> <br />
        <label for="reponse">Nouvelle Réponse :</label>
        <input type="text" name="reponse" id="reponse" /> </p> 
 
 
    <input type="submit" value="Mettre à jour le profil" />
    
    <?php if(isset($msg)) {echo $msg;}   ?>
        
 
 
<?php
//includes $conn
 include('config.php');
 
//Selectionner toutes les entrées de la table account
        $req = "SELECT username, question, reponse, password FROM users WHERE username = ".$_SESSION['username']."";
        $requser = $conn -> prepare($req);
        $requser -> execute();
        $user = $requser-> fetch();
 
        echo $user['username'];
 
 
if(isset($_POST['new_username']) AND !empty($_POST['new_username']) AND $_POST['new_username'] != $user['username'])
{
        $new_username = htmlspecialchars($_POST['new_username']);
        $req1 = "UPDATE account SET mail ='".$new_username."' WHERE username = '".$_SESSION['username']."';";
        $new_username = $conn->prepare($req1);
        $new_username-> execute();
       
        echo "Votre mail à bien été changé.";
   
}
 
if (isset($_POST['remplace_MDP']) && isset($_POST['mdp2']) AND !empty($_POST['remplace_MDP']) AND !empty($_POST['mdp2']))
{
 
        if ($_POST['remplace_MDP'] == $_POST['mdp2'])
     {
        echo $_POST['remplace_MDP'];
    $remplace_MDP = password_hash($_POST['remplace_MDP']);
    $ModificationMDP= "UPDATE account SET password='" . $remplace_MDP . "' WHERE username='" . $_SESSION['username'] . "'; ";
    $resultat=$conn->prepare($ModificationMDP);
    $resultat->execute();
   
    echo "Votre MDP a été changé";
 
        }
        else
        {
                $msg = "Vos deux mots de passe ne correspondent pas !";
        }
       
      
}
 
 
 
 
 
 
?>
<footer> <?php include ("footer.php")?></footer>
    </body>