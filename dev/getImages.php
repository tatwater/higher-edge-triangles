<?php
  $topicID = $_GET["topic_id"];
  
  // Set up connection to MySQL
  $db_connection = mysql_connect("localhost", "root", "", false, 128);
  if (!$db_connection)
    die("Unable to connect: " . mysql_error());
  
  // Connect to project database
  mysql_select_db("project_polygon", $db_connection);
  
  // Make a list of all images for the current topic
  $imageList = array();
  $temp = mysql_query("SELECT * FROM images WHERE topic_id = '" . $topicID . "';", $db_connection);
  while ($imageRow = mysql_fetch_array($temp)) {
    array_push($imageList, $imageRow["url"]);
  }
  
  // Return a formatted array to to js
  echo $imageList[0];
  for ($i = 1; $i < count($imageList); $i++)
    echo "," . $imageList[$i];
?>