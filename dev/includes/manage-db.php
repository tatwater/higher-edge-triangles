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
  else if (isset($_GET["insert"])) {
    mysql_select_db("project_polygon", $db_connection);
    
    // Insert into topics
    $cmd = "INSERT INTO topics (title, category, numDuplicates, description)
              VALUES ('" . $_GET["title"] . "',
                      '" . $_GET["category"] . "',
                      '" . $_GET["numDuplicates"] . "',
                      '" . $_GET["description"] . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'topics' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'topics': " . mysql_error() . "<br />";
    
    // Retrieve topic id
    $record = mysql_query("SELECT * FROM topics WHERE id = (SELECT MAX(id) FROM topics);", $db_connection);
    $row = mysql_fetch_array($record);
    $topicID = $row["id"];
    $noticeText .= "ID: " . $topicID . "<br />";
    
    
    $cfg['PersistentConnections'] = FALSE;
    
    // Insert into images
    $cmd = "INSERT INTO images (url, topic_id)
              VALUES ('" . $_GET["image1_url"] . "',
                      '" . $topicID . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'images' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'images': " . mysql_error() . "<br />";
    
    // Insert into majors
    $cmd = "INSERT INTO majors (name, url)
              VALUES ('" . $_GET["major1"] . "',
                      '" . $_GET["major1_url"] . "'),
                     ('" . $_GET["major2"] . "',
                      '" . $_GET["major2_url"] . "'),
                     ('" . $_GET["major3"] . "',
                      '" . $_GET["major3_url"] . "'),
                     ('" . $_GET["major4"] . "',
                      '" . $_GET["major4_url"] . "'),
                     ('" . $_GET["major5"] . "',
                      '" . $_GET["major5_url"] . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'majors' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'majors': " . mysql_error() . "<br />";
    
    // Insert into colleges
    $cmd = "INSERT INTO colleges (name, url)
              VALUES ('" . $_GET["college1"] . "',
                      '" . $_GET["college1_url"] . "'),
                     ('" . $_GET["college2"] . "',
                      '" . $_GET["college2_url"] . "'),
                     ('" . $_GET["college3"] . "',
                      '" . $_GET["college3_url"] . "'),
                     ('" . $_GET["college4"] . "',
                      '" . $_GET["college4_url"] . "'),
                     ('" . $_GET["college5"] . "',
                      '" . $_GET["college5_url"] . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'colleges' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'colleges': " . mysql_error() . "<br />";
    
    // Insert into careers
    $cmd = "INSERT INTO careers (name, url)
              VALUES ('" . $_GET["career1"] . "',
                      '" . $_GET["career1_url"] . "'),
                     ('" . $_GET["career2"] . "',
                      '" . $_GET["career2_url"] . "'),
                     ('" . $_GET["career3"] . "',
                      '" . $_GET["career3_url"] . "'),
                     ('" . $_GET["career4"] . "',
                      '" . $_GET["career4_url"] . "'),
                     ('" . $_GET["career5"] . "',
                      '" . $_GET["career5_url"] . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'careers' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'careers': " . mysql_error() . "<br />";
    
    // Insert into major_topic
    $cmd = "INSERT INTO major_topic (major_name, topic_id)
              VALUES ('" . $_GET["major1"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["major2"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["major3"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["major4"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["major5"] . "',
                      '" . $topicID . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'major_topic' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'major_topic': " . mysql_error() . "<br />";
    
    // Insert into college_topic
    $cmd = "INSERT INTO college_topic (college_name, topic_id)
              VALUES ('" . $_GET["college1"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["college2"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["college3"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["college4"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["college5"] . "',
                      '" . $topicID . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'college_topic' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'college_topic': " . mysql_error() . "<br />";
    
    // Insert into career_topic
    $cmd = "INSERT INTO career_topic (career_name, topic_id)
              VALUES ('" . $_GET["career1"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["career2"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["career3"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["career4"] . "',
                      '" . $topicID . "'),
                     ('" . $_GET["career5"] . "',
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
//  else if (isset($_GET["edit"])) {
//    
//  }
//  
//  // Remove existing record
//  else if (isset($_GET["remove"])) {
//    
//  }
?>