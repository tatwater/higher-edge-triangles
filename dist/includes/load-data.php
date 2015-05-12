<?php
  include "db-connect.php";

  // Find number of topics in database
  $lastRecord = mysql_query("SELECT * FROM topics WHERE id = (SELECT MAX(id) FROM topics);", $db_connection);
  $last = mysql_fetch_array($lastRecord);
  $numTopics = $last["id"];
  
  // Set topic ID, random if not provided
  if (isset($_GET["topic_id"]))
    $topicID = $_GET["topic_id"];
  else
    $topicID = rand(1, $numTopics);
  
  // Get data from 'topic' table
  $topicData = mysql_fetch_array(mysql_query("SELECT * FROM topics WHERE id = '" . $topicID . "';", $db_connection));
  
  // Get placeholder image from 'image' table
  $firstImageData = mysql_fetch_array(mysql_query("SELECT * FROM images WHERE topic_id = '" . $topicID . "' LIMIT 1;", $db_connection));
  
  $majorData = array();
  $temp = mysql_query("SELECT * FROM major_topic WHERE topic_id = '" . $topicID . "';", $db_connection);
  while ($majorTopicRow = mysql_fetch_array($temp)) {
    $temp2 = mysql_query("SELECT * FROM majors WHERE name = '" . $majorTopicRow["major_name"] . "';", $db_connection);
    while ($majorRow = mysql_fetch_array($temp2)) {
      array_push($majorData, array($majorRow["name"], $majorRow["url"]));
    }
  }
  
  $collegeData = array();
  $temp = mysql_query("SELECT * FROM college_topic WHERE topic_id = '" . $topicID . "';", $db_connection);
  while ($collegeTopicRow = mysql_fetch_array($temp)) {
    $temp2 = mysql_query("SELECT * FROM colleges WHERE name = '" . $collegeTopicRow["college_name"] . "';", $db_connection);
    while ($collegeRow = mysql_fetch_array($temp2)) {
      array_push($collegeData, array($collegeRow["name"], $collegeRow["url"]));
    }
  }
  
  $careerData = array();
  $temp = mysql_query("SELECT * FROM career_topic WHERE topic_id = '" . $topicID . "';", $db_connection);
  while ($careerTopicRow = mysql_fetch_array($temp)) {
    $temp2 = mysql_query("SELECT * FROM careers WHERE name = '" . $careerTopicRow["career_name"] . "';", $db_connection);
    while ($careerRow = mysql_fetch_array($temp2)) {
      array_push($careerData, array($careerRow["name"], $careerRow["url"]));
    }
  }
?>