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
    <meta charset='utf8'>
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
            $servname = "localhost"; $dbname = "extranet"; $user = "root"; $pass = "";
            //Exeptionfor error handling -_-
            //if the expection does not trigger script will continue
            //PDO =php data object
            try{
                $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //Prepared Request
                //Select values acteur,description and logo from table 'Acteur'
                $sth = $dbco->prepare("SELECT acteur, description,logo FROM acteurs");
                $sth->execute();
                
                
                //Brings in array for every entry in table
                //fetch_assoc() function fetches a result row as an associative array.
                $resultat = $sth->fetchAll(PDO::FETCH_ASSOC); 
                
                //Print_R =Formated array display
                // <pre></pre> Improves readability
                echo '<pre>';
                print_r($resultat);
                echo '</pre>';
                

            }
            //Cath the exepction(try) and creates exeption information      
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
        ?>
  </body>
</html>