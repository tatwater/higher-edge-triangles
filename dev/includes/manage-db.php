<?php
  include "db-connect.php";
  
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
//    
//  }
  
  // Remove existing record
//  else if (isset($_POST["remove"])) {
//    
//  }
?>