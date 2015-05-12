<?php
  // Create 'project_polygon' database
  if (mysql_query("CREATE DATABASE project_polygon;", $db_connection)) {
    mysql_select_db("project_polygon", $db_connection);
    
    // Create 'topics' table
    $cmd = "CREATE TABLE topics(
              id int(4) AUTO_INCREMENT PRIMARY KEY,
              title varchar(32),
              category varchar(32),
              numDuplicates int(4),
              description varchar(256)
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'topics' created successfully.<br />";
    else
      $noticeText .= "Unable to create table 'topics': " . mysql_error() . "<br />";
    
    // Create 'images' table
    $cmd = "CREATE TABLE images(
              url varchar(32) NOT NULL PRIMARY KEY,
              topic_id int(4) REFERENCES topics(id)
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table created successfully.<br />";
    else
      $noticeText .= "Unable to create table 'images': " . mysql_error() . "<br />";
    
    // Create 'majors' table
    $cmd = "CREATE TABLE majors(
              name varchar(32) NOT NULL PRIMARY KEY,
              url varchar(32)
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'majors' created successfully.<br />";
    else
      $noticeText .= "Unable to create table 'majors': " . mysql_error() . "<br />";
    
    // Create 'colleges' table
    $cmd = "CREATE TABLE colleges(
              name varchar(32) NOT NULL PRIMARY KEY,
              url varchar(32)
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table created successfully.<br />";
    else
      $noticeText .= "Unable to create table 'colleges': " . mysql_error() . "<br />";
    
    // Create 'careers' table
    $cmd = "CREATE TABLE careers(
              name varchar(32) NOT NULL PRIMARY KEY,
              url varchar(32)
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'careers' created successfully.<br />";
    else
      $noticeText .= "Unable to create table 'careers': " . mysql_error() . "<br />";
    
    // Create 'major_topic' table
    $cmd = "CREATE TABLE major_topic(
              major_name varchar(32) REFERENCES majors(name),
              topic_id int(4) REFERENCES topics(id)
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'major_topic' created successfully.<br />";
    else
      $noticeText .= "Unable to create table 'major_topic': " . mysql_error() . "<br />";
    
    // Create 'college_topic' table
    $cmd = "CREATE TABLE college_topic(
              college_name varchar(32) REFERENCES colleges(name),
              topic_id int(4) REFERENCES topics(id)
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'college_topic' created successfully.<br />";
    else
      $noticeText .= "Unable to create table 'college_topic': " . mysql_error() . "<br />";
    
    // Create 'career_topic' table
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
?>