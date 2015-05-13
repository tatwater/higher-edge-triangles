<?php
  include "db-connect.php";
  
  // If database is empty, quit
  if (!mysql_fetch_array(mysql_query("SELECT * FROM topics;", $db_connection)))
    die("Unable to load from database 'project_polygon': " . mysql_error());

  // Find number of topics in database
  $lastRecord = mysql_query("SELECT * FROM topics WHERE id=(SELECT MAX(id));", $db_connection);
  $last = mysql_fetch_array($lastRecord);
  $numTopics = $last["id"];
  
  // Set topic ID, random from existing if not provided or invalid
  if (isset($_GET["topic_id"]) && mysql_fetch_array(mysql_query("SELECT * FROM topics WHERE id='" . $_GET["topic_id"] . "';", $db_connection)))
    $topicID = $_GET["topic_id"];
  else {
    $topicID = rand(1, $numTopics);
    while (!mysql_fetch_array(mysql_query("SELECT * FROM topics WHERE id='" . $topicID . "';", $db_connection)))
      $topicID = rand(1, $numTopics);
  }
  
  // Calculate closest previous topic ID
  for ($i = 2; $i <= 2 * $numTopics; $i++) {
    $prevTopicID = ($topicID + $numTopics - $i) % $numTopics + 1;
    if (mysql_fetch_array(mysql_query("SELECT * FROM topics WHERE id='" . $prevTopicID . "';", $db_connection)))
      break;
  }
  
  // Calculate closest next topic ID
  for ($i = 0; $i <= 2 * $numTopics; $i++) {
    $nextTopicID = ($topicID + $numTopics + $i) % $numTopics + 1;
    if (mysql_fetch_array(mysql_query("SELECT * FROM topics WHERE id='" . $nextTopicID . "';", $db_connection)))
      break;
  }
  
  // Get data from 'topics' table
  $topicData = mysql_fetch_array(mysql_query("SELECT * FROM topics WHERE id='" . $topicID . "';", $db_connection));
  
  // Get placeholder image from 'images' table
  $firstImageData = mysql_fetch_array(mysql_query("SELECT * FROM images WHERE topic_id='" . $topicID . "' LIMIT 1;", $db_connection));
  
  // Get data from 'majors' table with current topic ID via 'major_topic'
  $majorData = array();
  $cmd = mysql_query("SELECT * FROM major_topic WHERE topic_id='" . $topicID . "';", $db_connection);
  while ($majorTopicRow = mysql_fetch_array($cmd)) {
    $cmd2 = mysql_query("SELECT * FROM majors WHERE name='" . $majorTopicRow["major_name"] . "';", $db_connection);
    while ($majorRow = mysql_fetch_array($cmd2))
      array_push($majorData, array($majorRow["name"], $majorRow["url"]));
  }
  
  // Get data from 'colleges' table with current topic ID via 'college_topic'
  $collegeData = array();
  $cmd = mysql_query("SELECT * FROM college_topic WHERE topic_id='" . $topicID . "';", $db_connection);
  while ($collegeTopicRow = mysql_fetch_array($cmd)) {
    $cmd2 = mysql_query("SELECT * FROM colleges WHERE name='" . $collegeTopicRow["college_name"] . "';", $db_connection);
    while ($collegeRow = mysql_fetch_array($cmd2))
      array_push($collegeData, array($collegeRow["name"], $collegeRow["url"]));
  }
  
  // Get data from 'careers' table with current topic ID via 'career_topic'
  $careerData = array();
  $cmd = mysql_query("SELECT * FROM career_topic WHERE topic_id='" . $topicID . "';", $db_connection);
  while ($careerTopicRow = mysql_fetch_array($cmd)) {
    $cmd2 = mysql_query("SELECT * FROM careers WHERE name='" . $careerTopicRow["career_name"] . "';", $db_connection);
    while ($careerRow = mysql_fetch_array($cmd2))
      array_push($careerData, array($careerRow["name"], $careerRow["url"]));
  }
?>