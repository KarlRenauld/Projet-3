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
    <link rel="stylesheet" href="style.css" />
    <meta charset='utf8_general_ci'>
  </head>
  <body>
    <div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
    <p>C'est votre tableau de bord.</p>
    <a href="logout.php">Déconnexion</a>
    <br>
    <a href="account_mod.php">Modifier Compte</a>
    </div>

      <h1>Acteurs</h1>  
        <?php
       $servername = 'localhost';
       $username = 'root';
       $password = '';
       $dbname = 'extranet'; 
       //create connection
       $conn = new mysqli($servername,$username,$password,$dbname);
       //check connection
       if ($conn->connect_error) {
        die('connection failed' . $conn->connect_error);
       }
       $sql = ('SELECT acteur, description FROM acteurs ');
       
       $result = $conn-> query($sql);

       if ($result->num_rows > 0) {
        //show data
        while ($row = $result -> fetch_assoc()) {
            echo "Acteur: " .$row['acteur']. '<br><br>',  "Description: " .$row['description']. '<br>','<br>' ;
           
        }
          
       }
        ?>
<img src="images/cde.png">
<a href="section_commentaire.php"> test $_GET</a>
  </body>
</html>
