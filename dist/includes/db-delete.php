<?php
  $imageListCmd = mysql_query("SELECT * FROM images WHERE topic_id='" . $_POST["topic_id"] . "';", $db_connection);
  
  // Remove all records with given topic ID from all tables
  if (mysql_query("DELETE FROM topics WHERE id='" . $_POST["topic_id"] . "';", $db_connection) &&
      mysql_query("DELETE FROM images WHERE topic_id='" . $_POST["topic_id"] . "';", $db_connection) &&
      mysql_query("DELETE FROM major_topic WHERE topic_id='" . $_POST["topic_id"] . "';", $db_connection) &&
      mysql_query("DELETE FROM college_topic WHERE topic_id='" . $_POST["topic_id"] . "';", $db_connection) &&
      mysql_query("DELETE FROM career_topic WHERE topic_id='" . $_POST["topic_id"] . "';", $db_connection)) {
    // Remove all uploaded images with given topic ID
    while ($imageListRow = mysql_fetch_array($imageListCmd))
      if(file_exists("img/uploads/" . $imageListRow["url"]))
        unlink("img/uploads/" . $imageListRow["url"]);
    $noticeText .= "Record deleted successfully.<br />";
  }
  else
    $noticeText .= "Unable to delete record: " . mysql_error() . "<br />";
?>