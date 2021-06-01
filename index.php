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
    <?php include('header.php') ?>
  </head>
  <body class="body">
      <link rel="stylesheet" type="text/css" href="CSS/home.css">
     <?php
     // Find and list down all the acteurs
      include_once('config.php');
      $req = $connection->prepare('SELECT id, logo, name, SUBSTRING(description, 1, 120) as detail FROM acteurs');
      $req->execute();
      if ($req->rowCount() == 0) {
      echo "<br>Pas d'acteur.<br />";
      } 
      else {
        while ($row = $req->fetchAll()) {
        //var_dump($row);
        // How to show blob data to HTML? = just save the image name in database
        ?>
    <section class="gbaf-description">
      <article>
        <h1>Le Groupement Banque Assurance Français(GBAF)</h1>
        
        <p>Global Banking & Finance Review est un magazine en ligne et imprimé de premier plan, qui a évolué à partir du besoin croissant d'avoir une vue plus équilibrée, pour des informations informatives et indépendantes au sein de la communauté financière. Nos contributeurs expérimentés fournissent cette qualité et une vision approfondie de manière claire et concise, fournissant aux principaux acteurs et aux chiffres clés des informations à jour sur le secteur financier.
        </p>
        <br>
      </article>
    </section>
    <h2 class="h2-acteurs">Acteurs et Partenaires</h2>
    <!-- List of all the acteurs -->
      <?php foreach ($row as $entry) {
      ?>
      <section class="card">
        <div class="card-image">
          <img src="images/<?php echo $entry['logo']; ?>" alt="Acteur-image">
        </div>
        <div class="card-content">
          <h3><?php echo $entry['name']; ?></h3>
          <p><?php echo $entry['detail']; ?></p>
          <span><a class="card-link" href="acteur.php?acteur=<?php echo $entry['id']; ?>">Lire la suite</a></span>
        </div>
      </section>
    <?php }
  }
}

include_once('footer.html');
?>
</body>
