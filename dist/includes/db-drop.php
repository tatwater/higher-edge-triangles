<?php
  // Drop whole database and all tables
  if (mysql_query("DROP DATABASE project_polygon;", $db_connection))
    $noticeText .= "Database dropped successfully.<br />";
  else
    $noticeText .= "Unable to drop database: " . mysql_error() . "<br />";
?>