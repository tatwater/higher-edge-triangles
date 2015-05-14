<?php
  include "db-connect.php";
  
  $topicID = $_GET["topic_id"];
  
  // Make an array of all image names for the current topic
  $imageList = array();
  $temp = mysql_query("SELECT * FROM images WHERE topic_id = '" . $topicID . "';", $db_connection);
  while ($imageRow = mysql_fetch_array($temp))
    array_push($imageList, $imageRow["url"]);
  
  // Return a formatted list to to js
  echo $imageList[0];
  for ($i = 1; $i < count($imageList); $i++)
    echo "," . $imageList[$i];
?>