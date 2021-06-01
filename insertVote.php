<?php

  // Start a session
  session_start();
  // Verify if user is connected, if not, redirect to Login page
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }

    include_once('config.php');

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      //The http_response_code() function sets or returns the HTTP response status code. in this case 403
      http_response_code(403); // Status Code: 403 Forbidden
      die();
    }

    $sqlUser = $connection->prepare('SELECT id FROM accounts WHERE username=?');
    $sqlUser->execute([$_SESSION['username']]);
    $userData = $sqlUser->fetch();
    // print_r($userData['id']);
    $userId = $userData['id'];

    include_once('Vote.php');

    $vote = new Vote($connection);

    //IF vote count ==0 then user can vote.
    //if vote count is <0 then DIE.
    if ($_GET['vote'] > 0) {
      die();
    }

    if ($_GET['vote'] == 1) {
      $vote->like('acteurs', $_GET['ref_id'], $userId);
      // How do all the functions been used?
      // like()->vote()->recordExists()
    } else if ($_GET['vote'] == -1) {
      $vote->dislike('acteurs', $_GET['ref_id'], $userId);
    }

    header('Location: acteur.php?acteur='. $_COOKIE['acteur_id'] .'');

?>