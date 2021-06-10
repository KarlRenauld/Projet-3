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
        

                $sql = $connection-> prepare("SELECT comment_username FROM posts WHERE comment_username = ? AND bank_id = ?" );
                $sql-> execute([$_SESSION['username'],$_COOKIE['acteur_id']]);
                  //If Rowcount is higher than 0 then its allready commented.
                if ($sql->rowCount() > 0) {
                  header('Location: acteur.php?acteur='. $_COOKIE['acteur_id'] .'');
                exit();
                };        
                //Insert using both username AND id from accounts 
                //Index user_id such that user_id = Child / accounts.id = Parent
                $today = date("Y-m-d");
                $req = $connection->prepare('INSERT INTO posts (bank_id, date_created, comment, comment_username, user_id) VALUES (?, NOW(), ?, ?,  (SELECT accounts.id FROM accounts WHERE accounts.username=?))');

                $data = $req->execute([$_COOKIE['acteur_id'], $_POST['comment'], $_POST['author'], $_POST['author']]);
                
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