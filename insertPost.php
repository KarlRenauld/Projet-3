<?php
  include_once('session.php');
  // Insert new comment:
  if (isset($_COOKIE['acteur_id'])) {
     echo "value is :" . $_COOKIE['acteur_id'];
    try {
      //If any of the area is empty 
      if ($_POST['author'] == '' || $_POST['date'] == '' || $_POST['comment'] == '')  {
        throw new Exception("veuillez remplir tous les champs avant d'envoyer");
      } else {
        include_once('config.php');
       
                $req = $connection-> prepare("INSERT INTO posts (bank_id, comment, date_created, user_id) VALUES (?, ?, NOW(), ?)");
        $data = $req->execute([$_COOKIE['acteur_id'], $_POST['comment'], $_POST['author']]);
        header('Location: acteur.php?acteur='. $_COOKIE['acteur_id'] .'');
        exit();
      }
    } catch (Exception $e) {
      $_SESSION['error'] = $e->getMessage();
      header('Location: acteur.php?acteur='. $_COOKIE['acteur_id'] .'');
      exit();
    }
  }
?>
