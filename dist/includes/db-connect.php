<?php    
  // To be filled with build messages
  $noticeText = "";
  
  // Set up connection to MySQL
  $db_connection = mysql_connect("localhost", "root", "", false, 128);
  if (!$db_connection)
    die("Unable to connect to MySQL: " . mysql_error());
  
  // Select project database
  if (!mysql_select_db("project_polygon", $db_connection) && !isset($_GET["create"]))
    die("Unable to select database 'project_polygon'.");
?>