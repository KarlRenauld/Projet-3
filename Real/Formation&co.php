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
	<title>Formation&Co</title>
</head>
<body>

 <div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
    <p></p>
    <a href="logout.php">Déconnexion</a>
    <br>
    <a href="account_mod.php">Modifier Compte</a>
    </div>

    <div id=logoActeur class="logoActeur">
    	<br>    
        <img src='Images/formation_co.png'  alt= 'Logo Acteur'; title='' width="400px"/> </div>
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

       $sql = 'SELECT description FROM acteurs WHERE id = 1 ';
       if ($result = $conn -> query($sql)) {
       	while ($row = $result -> fetch_row()) {
       		printf($row[1]);
       		$result -> free_result();
       		# code...
       	}
       	# code...
       }
       $result = $conn->query($sql);

       

       //---------------//

        $sql = 'SELECT acteur, description FROM acteurs WHERE Id_acteur = 1';
       $result = $conn-> query($sql);

       if ($result->num_rows > 0) {
        //show data
        while ($row = $result -> fetch_assoc()) {
            echo "Acteur: " .$row['acteur']. '<br><br>',  "Description: " .$row['description']. '<br>' ;
  }

        }
          
       
       ?>
</body>
</html>