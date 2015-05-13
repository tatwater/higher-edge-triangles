<?php
  include "db-connect.php";
  
  // If the user entered a password and it's correct, or if using $_GET functions
  if (isset($_GET["create"]) || isset($_GET["drop"]) || (isset($_POST["password"]) && mysql_fetch_array(mysql_query("SELECT * FROM users WHERE password='" . crypt($_POST["password"], "ccdpp2015") . "';", $db_connection)))) {
    
    // Create new database and all tables
    if (isset($_GET["create"])) {
      include "db-create.php";
    }
    
    // Drop existing database and all tables
    else if (isset($_GET["drop"])) {
      include "db-drop.php";
    }
    
    // Insert new topic data into all tables
    else if (isset($_POST["insert"])) {
      include "db-insert.php";
    }
    
    // Edit existing record
  //  else if (isset($_POST["edit"])) {
  //    // Coming soon!
  //  }
    
    // Remove existing record
    else if (isset($_POST["delete"])) {
      include "db-delete.php";
    }
  }
  else if (isset($_POST["password"]))
    $noticeText .= "Incorrect password. Please try again.<br />";
?>