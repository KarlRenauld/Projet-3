<?php
	session_start();
include('config.php');
   // t = from the like/dislike button
   //
   if(isset($_GET['t'],$_GET['id']) AND !empty($_GET['t']) AND !empty($_GET['id'])) {#
      //verify its an int
      $getid = (int) $_GET['id'];
      $gett = (int) $_GET['t'];
      $sessionid = $_SESSION["username"];

      $check = $connection->prepare('SELECT id FROM acteurs WHERE id = ?');
      $check->execute(array($getid));
      // 1 being Like
      if($check->rowCount() == 1) {
         if($gett == 1) {
            $check_like = $connection->prepare('SELECT id FROM likes WHERE id_article = ? AND id_membre = ?');
            $check_like->execute(array($getid,$sessionid));
            //delete existing dislike
            $del = $connection->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
            $del->execute(array($getid,$sessionid));
            if($check_like->rowCount() == 1) {
            //delete existing like   
               $del = $connection->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
               $del->execute(array($getid,$sessionid));
            } else {
               $ins = $connection->prepare('INSERT INTO likes (id_article, id_membre, user_id) VALUES (?, ?, (SELECT accounts.id FROM accounts WHERE accounts.username=?))');
               $ins->execute(array($getid, $sessionid, $_SESSION['username']));
            }
            
         } 
         //2 being dislike
         elseif($gett == 2) {
            $check_like = $connection->prepare('SELECT id FROM dislikes WHERE id_article = ? AND id_membre = ?');
            $check_like->execute(array($getid,$sessionid));
            $del = $connection->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
            $del->execute(array($getid,$sessionid));
            if($check_like->rowCount() == 1) {
               $del = $connection->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
               $del->execute(array($getid,$sessionid));
            } else {
               $ins = $connection->prepare('INSERT INTO dislikes (id_article, id_membre, user_id) VALUES (?, ?, (SELECT accounts.id FROM accounts WHERE accounts.username=?))');
               $ins->execute(array($getid, $sessionid, $_SESSION['username']));
            }
         }
          header('Location: acteur.php?acteur='. $_COOKIE['acteur_id'] .'');
      } else {
         exit('Erreur fatale.');
      }
   } else {
      exit('Erreur fatale.');
   }
