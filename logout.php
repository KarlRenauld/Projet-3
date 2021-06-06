<?php
  // Initialise session
  session_start();
  
  // Close session.
  if(session_destroy())
  {
    // Redirect  to login
    header("Location: login.php");
  }
?>