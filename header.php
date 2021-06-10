
    <link rel="stylesheet" href="CSS/header.css" />
     <meta name="viewport" content="user-scalable=yes, width=device-width, initial-scale=1.0" />
      <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta charset='utf-8'>
   
    <section  class="header" id="container_header">

    <div>
        <a href="index.php">
            <img class="" src="images/logo_gbaf.png" width="150" height="160" alt="logo_gbaf">
        </a>
        
    </div>

    <div class="account_box"><h3>Bienvenue <?php echo $_SESSION['firstname'];?> <?php  echo $_SESSION['lastname']; ?>!</h3>
    
    <a href="logout.php">Déconnexion</a>
    <br>
    <a href="account_mod.php">Modifier Compte</a>
    <br>
    <a href="index.php">Accueil</a>
    </div></section>



