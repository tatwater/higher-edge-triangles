<?php
  $noticeText = "";
  
  // Set up connection to database
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
        $noticeText .= "'topics' created successfully.<br />";
      else
        $noticeText .= "Unable to create table: " . mysql_error() . "<br />";
      
      // images table
      $cmd = "CREATE TABLE images(
                url varchar(32) NOT NULL PRIMARY KEY,
                topic_id int(4) REFERENCES topics(id)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "'images' created successfully.<br />";
      else
        $noticeText .= "Unable to create table: " . mysql_error() . "<br />";
      
      // majors table
      $cmd = "CREATE TABLE majors(
                name varchar(32) NOT NULL PRIMARY KEY,
                url varchar(32)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "'majors' created successfully.<br />";
      else
        $noticeText .= "Unable to create table: " . mysql_error() . "<br />";
      
      // colleges table
      $cmd = "CREATE TABLE colleges(
                name varchar(32) NOT NULL PRIMARY KEY,
                url varchar(32)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "'colleges' created successfully.<br />";
      else
        $noticeText .= "Unable to create table: " . mysql_error() . "<br />";
      
      // careers table
      $cmd = "CREATE TABLE careers(
                name varchar(32) NOT NULL PRIMARY KEY,
                url varchar(32)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "'careers' created successfully.<br />";
      else
        $noticeText .= "Unable to create table: " . mysql_error() . "<br />";
      
      // major_topic table
      $cmd = "CREATE TABLE major_topic(
                major_name varchar(32) REFERENCES majors(name),
                topic_id int(4) REFERENCES topics(id)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "'major_topic' created successfully.<br />";
      else
        $noticeText .= "Unable to create table: " . mysql_error() . "<br />";
      
      // college_topic table
      $cmd = "CREATE TABLE college_topic(
                college_name varchar(32) REFERENCES colleges(name),
                topic_id int(4) REFERENCES topics(id)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "'college_topic' created successfully.<br />";
      else
        $noticeText .= "Unable to create table: " . mysql_error() . "<br />";
      
      // career_topic table
      $cmd = "CREATE TABLE career_topic(
                career_name varchar(32) REFERENCES careers(name),
                topic_id int(4) REFERENCES topics(id)
              );";
      if (mysql_query($cmd, $db_connection))
        $noticeText .= "'career_topic' created successfully.<br />";
      else
        $noticeText .= "Unable to create table: " . mysql_error() . "<br />";
    }
    else
      $noticeText .= "Unable to create database: " . mysql_error() . "<br />";
  }
  
  // Drop old database
  else if (isset($_GET["drop"])) {
    if(mysql_query("DROP DATABASE project_polygon;", $db_connection))
      $noticeText .= "Database dropped successfully.<br />";
    else
      $noticeText .= "Unable to delete database: " . mysql_error() . "<br />";
  }
?>