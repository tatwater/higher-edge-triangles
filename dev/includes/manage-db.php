<?php
  $noticeText = "";
  
  // Set up connection to MySQL
  $db_connection = mysql_connect("localhost", "root", "", false, 128);
  if (!$db_connection)
    die("Unable to connect: " . mysql_error());
  
  // Create new database and all tables
  if (isset($_GET["create"])) {
    if (mysql_query("CREATE DATABASE project_polygon;", $db_connection)) {
      mysql_select_db("project_polygon", $db_connection);
      
      // topics table
      $cmd = "CREATE TABLE topics(
                id int(4) AUTO_INCREMENT PRIMARY KEY,
                title varchar(32),
                category varchar(32),
                numDuplicates int(4),
                description varchar(32)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "Table 'topics' created successfully.<br />";
      else
        $noticeText .= "Unable to create table 'topics': " . mysql_error() . "<br />";
      
      // images table
      $cmd = "CREATE TABLE images(
                url varchar(32) NOT NULL PRIMARY KEY,
                topic_id int(4) REFERENCES topics(id)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "Table created successfully.<br />";
      else
        $noticeText .= "Unable to create table 'images': " . mysql_error() . "<br />";
      
      // majors table
      $cmd = "CREATE TABLE majors(
                name varchar(32) NOT NULL PRIMARY KEY,
                url varchar(32)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "Table 'majors' created successfully.<br />";
      else
        $noticeText .= "Unable to create table 'majors': " . mysql_error() . "<br />";
      
      // colleges table
      $cmd = "CREATE TABLE colleges(
                name varchar(32) NOT NULL PRIMARY KEY,
                url varchar(32)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "Table created successfully.<br />";
      else
        $noticeText .= "Unable to create table 'colleges': " . mysql_error() . "<br />";
      
      // careers table
      $cmd = "CREATE TABLE careers(
                name varchar(32) NOT NULL PRIMARY KEY,
                url varchar(32)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "Table 'careers' created successfully.<br />";
      else
        $noticeText .= "Unable to create table 'careers': " . mysql_error() . "<br />";
      
      // major_topic table
      $cmd = "CREATE TABLE major_topic(
                major_name varchar(32) REFERENCES majors(name),
                topic_id int(4) REFERENCES topics(id)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "Table 'major_topic' created successfully.<br />";
      else
        $noticeText .= "Unable to create table 'major_topic': " . mysql_error() . "<br />";
      
      // college_topic table
      $cmd = "CREATE TABLE college_topic(
                college_name varchar(32) REFERENCES colleges(name),
                topic_id int(4) REFERENCES topics(id)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "Table 'college_topic' created successfully.<br />";
      else
        $noticeText .= "Unable to create table 'college_topic': " . mysql_error() . "<br />";
      
      // career_topic table
      $cmd = "CREATE TABLE career_topic(
                career_name varchar(32) REFERENCES careers(name),
                topic_id int(4) REFERENCES topics(id)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "Table 'career_topic' created successfully.<br />";
      else
        $noticeText .= "Unable to create table 'career_topic': " . mysql_error() . "<br />";
    }
    else
      $noticeText .= "Unable to create database: " . mysql_error() . "<br />";
  }
  
  // Drop existing database and all tables
  else if (isset($_GET["drop"])) {
    if (mysql_query("DROP DATABASE project_polygon;", $db_connection))
      $noticeText .= "Database dropped successfully.<br />";
    else
      $noticeText .= "Unable to drop database: " . mysql_error() . "<br />";
  }
  
  // Insert new record
  else if (isset($_POST["insert"])) {
    mysql_select_db("project_polygon", $db_connection);
    
    // Insert into topics
    $cmd = "INSERT INTO topics (title, category, numDuplicates, description)
              VALUES ('" . $_POST["title"] . "',
                      '" . $_POST["category"] . "',
                      '" . count($_FILES["images"]["name"]) . "',
                      '" . $_POST["description"] . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'topics' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'topics': " . mysql_error() . "<br />";
    
    // Retrieve topic id
    $record = mysql_query("SELECT * FROM topics WHERE id = (SELECT MAX(id) FROM topics);", $db_connection);
    $row = mysql_fetch_array($record);
    $topicID = $row["id"];
    
    // Insert into images
    $valid_formats = array("jpg", "jpeg", "png", "gif");
    $max_file_size = 500000;
    $target_dir = "img/uploads/";
    
    foreach ($_FILES["images"]["name"] as $f => $name) {
      if ($_FILES["images"]["error"][$f] == 4) // if any error found, skip file
        continue;
      if ($_FILES["images"]["error"][$f] == 0)
        if ($_FILES['images']['size'][$f] > $max_file_size) { // skip files that are too large
          $noticeText .= "$name is too large.\n";
          continue;
        }
      	elseif (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)) { // skip non-image uploads
      		$noticeText .= "$name is not a valid format.\n";
      		continue;
      	}
        else
          if (move_uploaded_file($_FILES["images"]["tmp_name"][$f], $target_dir . $name)) {
            $cmd = "INSERT INTO images (url, topic_id)
                      VALUES ('" . $name . "',
                              '" . $topicID . "'
                    );";
            if (mysql_query($cmd, $db_connection))
              $noticeText .= "Image '" . $name . "' uploaded successfully.<br />";
            else
              $noticeText .= "Unable to upload image '" . $name . "': " . mysql_error() . "<br />";
          }
    }
    
    // Insert into majors
    $cmd = "INSERT INTO majors (name, url)
              VALUES ('" . $_POST["major1"] . "',
                      '" . $_POST["major1_url"] . "'),
                     ('" . $_POST["major2"] . "',
                      '" . $_POST["major2_url"] . "'),
                     ('" . $_POST["major3"] . "',
                      '" . $_POST["major3_url"] . "'),
                     ('" . $_POST["major4"] . "',
                      '" . $_POST["major4_url"] . "'),
                     ('" . $_POST["major5"] . "',
                      '" . $_POST["major5_url"] . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'majors' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'majors': " . mysql_error() . "<br />";
    
    // Insert into colleges
    $cmd = "INSERT INTO colleges (name, url)
              VALUES ('" . $_POST["college1"] . "',
                      '" . $_POST["college1_url"] . "'),
                     ('" . $_POST["college2"] . "',
                      '" . $_POST["college2_url"] . "'),
                     ('" . $_POST["college3"] . "',
                      '" . $_POST["college3_url"] . "'),
                     ('" . $_POST["college4"] . "',
                      '" . $_POST["college4_url"] . "'),
                     ('" . $_POST["college5"] . "',
                      '" . $_POST["college5_url"] . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'colleges' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'colleges': " . mysql_error() . "<br />";
    
    // Insert into careers
    $cmd = "INSERT INTO careers (name, url)
              VALUES ('" . $_POST["career1"] . "',
                      '" . $_POST["career1_url"] . "'),
                     ('" . $_POST["career2"] . "',
                      '" . $_POST["career2_url"] . "'),
                     ('" . $_POST["career3"] . "',
                      '" . $_POST["career3_url"] . "'),
                     ('" . $_POST["career4"] . "',
                      '" . $_POST["career4_url"] . "'),
                     ('" . $_POST["career5"] . "',
                      '" . $_POST["career5_url"] . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'careers' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'careers': " . mysql_error() . "<br />";
    
    // Insert into major_topic
    $cmd = "INSERT INTO major_topic (major_name, topic_id)
              VALUES ('" . $_POST["major1"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["major2"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["major3"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["major4"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["major5"] . "',
                      '" . $topicID . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'major_topic' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'major_topic': " . mysql_error() . "<br />";
    
    // Insert into college_topic
    $cmd = "INSERT INTO college_topic (college_name, topic_id)
              VALUES ('" . $_POST["college1"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["college2"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["college3"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["college4"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["college5"] . "',
                      '" . $topicID . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'college_topic' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'college_topic': " . mysql_error() . "<br />";
    
    // Insert into career_topic
    $cmd = "INSERT INTO career_topic (career_name, topic_id)
              VALUES ('" . $_POST["career1"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["career2"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["career3"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["career4"] . "',
                      '" . $topicID . "'),
                     ('" . $_POST["career5"] . "',
                      '" . $topicID . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'career_topic' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'career_topic': " . mysql_error() . "<br />";
  }
  
  mysql_select_db("project_polygon", $db_connection);
  $topics_table = mysql_query("SELECT * FROM topics;", $db_connection);
  $images_table = mysql_query("SELECT * FROM images;", $db_connection);
  $majors_table = mysql_query("SELECT * FROM majors;", $db_connection);
  $colleges_table = mysql_query("SELECT * FROM colleges;", $db_connection);
  $careers_table = mysql_query("SELECT * FROM careers;", $db_connection);
  $major_topic_table = mysql_query("SELECT * FROM major_topic;", $db_connection);
  $college_topic_table = mysql_query("SELECT * FROM college_topic;", $db_connection);
  $career_topic_table = mysql_query("SELECT * FROM career_topic;", $db_connection);
  
//  // Edit existing record
//  else if (isset($_POST["edit"])) {
//    
//  }
//  
//  // Remove existing record
//  else if (isset($_POST["remove"])) {
//    
//  }
?>