<?php
  // Start a session
  session_start();
  // Verify if user is connected, if not, redirect to Login page
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Acteurs </title>
  <?php include_once('header.php');?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/acteurs.css">
  <meta charset="utf-8">
</head>
<body>
  <?php
  include('config.php');
   $today = date("Y-m-d");
    if(isset($_GET['acteur'])) {
      //Set Cookies for use in getting information  during insertPost.php
      setcookie("acteur_id", $_GET['acteur'], time()+(60*60*24)); 
      // Get the acteur by id
      $req = $connection->prepare('SELECT * FROM acteurs WHERE id=?');
      $req->execute([$_GET['acteur']]);
      $data = $req->fetch();
      ?>
      <!-- Acteur's post -->
        <article class="post">
          <div class="large-logo">
            <img class="post-image" src="images/<?php echo $data['logo']; ?>" alt="logo">
          </div>
          <h2>
            <?php echo $data['name']; ?>
          </h2>
          <p>
            <!--Insert line breaks where newlines (\n) occur in the string and hide data-->
            <?php echo nl2br(htmlspecialchars($data['description'])); ?>
          </p>
          <br>
          <!-- Votes -->
          <?php
            
            $get_id = htmlspecialchars($_GET['acteur']);
            $article = $connection->prepare('SELECT * FROM acteurs WHERE id = ?');
            $article->execute(array($get_id));
            if($article->rowCount() == 1) {
              $article = $article->fetch();
              $id = $article['id'];
             
              $likes = $connection->prepare('SELECT id FROM likes WHERE id_article = ?');
              $likes->execute(array($id));
              $likes = $likes->rowCount();
              $dislikes = $connection->prepare('SELECT id FROM dislikes WHERE id_article = ?');
              $dislikes->execute(array($id));
              $dislikes = $dislikes->rowCount();
            } 
             else {
                die('Cet article n\'existe pas !');
              }
          ?>

         <div class="vote-comment-btns">
            <div class="">
              <form action="insertVote.php?t=1&id=<?= $id ?>" method="POST">
                <button type="submit" class="vote_btn vote_like ">
                  <i class="fas fa-thumbs-up"></i>Likes: &nbsp;(<?= $likes ?>)
                </button>
              </form>
              <form action="insertVote.php?t=2&id=<?= $id ?>" method="POST">
                <button type="submit" class="vote_btn vote_dislike">
                  <i class="fa fa-thumbs-down" aria-hidden="true"></i>Dislikes: &nbsp;(<?= $dislikes ?>)
                </button>
              </form>
            </div>
            <!-- Comment  -->     
            <div id="comment_btn">
              <button class="btnOnClick" ">Nouveau Commentaire</button>
            </div>
          </div>
          <br>
        </article>
        <!-- Comment form -->
        <div id="comment" style="display: none">
          <form class="comment-form" action="insertPost.php" method="POST">
              <label for="author">Prénom:</label><br><input type="text" name="author" id="author" value="<?php echo $_SESSION['username']; ?>">
              <label for="date">Date:</label><br><input type="date" name="date" id="date" value="<?= $today ?>"><br>

              <label for="comment">Votre Commentaire:</label><br><textarea name="comment" id="comment" cols="80" rows="8"></textarea><br>
              <input type="submit" value="Envoyer">
          </form>
        </div>
          <!-- Comments list -->
        <div class="comments-list">
          <h2>Commentaires</h2>
          <?php
          // Show all the comments by time but ONLY show date from every user for this bank
          // Find the firstname from `accounts` by user_id from `posts`
          // How to get date from type`datetime`: SELECT DATE_FORMAT(column_name, '%d-%m/%b-%Y') FROM table name
          $req = $connection->prepare("SELECT bank_id, user_id, comment, DATE_FORMAT(date_created, '%d-%m-%Y') AS date, first_name FROM posts
            JOIN accounts
            ON posts.user_id = accounts.username
            WHERE posts.bank_id = ?
            ORDER BY date_created DESC");

            $req->execute([$_GET['acteur']]);
            if ($req->rowCount() == 0) {
              echo "<p>(Pas de commentaire encore)</p>";
            } else {
              while ($data = $req->fetch()) { ?>
                <p><?php echo    '<span class="comment">' .
                $data['first_name'] . '</span>'; ?><span class="comment"><?php echo '&nbsp;&nbsp;' . $data['date']; ?></span><br>
                <?php echo htmlspecialchars($data['comment']) ?></p>
              <?php }
              //close cursor to enabling loop
              $req->closeCursor();
              ?>
          </div><?php
        }
    }
include_once('footer.html');
?>

