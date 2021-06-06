<link rel="stylesheet" href="CSS/header.css" />
    <meta charset='utf8_general_ci'>
    <section  class="header" id="container_header">

    <div>
    	<a href="index.php">
    		<img class="" src="images/logo_gbaf.png" width="150" height="auto">
    	</a>
    	
    </div>

    <div class="account_box"><h3>Bienvenue <?php echo $_SESSION['firstname'];?> <?php  echo $_SESSION['lastname']; ?>!</h3>
    
    <a href="logout.php">Déconnexion</a>
    <br>
    <a href="account_mod.php">Modifier Compte</a>
    <br>
    <a href="index.php">Accueil</a>
    </div></section>