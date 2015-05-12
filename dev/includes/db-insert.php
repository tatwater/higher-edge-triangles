<?php
  // If the submission has a unique title/category combination
  if ($_POST["title"] != "" && $_POST["category"] != "" && mysql_num_rows(mysql_query("SELECT * FROM topics WHERE title='" . $_POST["title"] . "' AND category='" . $_POST["category"] . "';", $db_connection)) == 0) {
  
    // Insert into 'topics' table
    $description = str_replace("'", "\'", $_POST["description"]); // Allow apostrophes
    $cmd = "INSERT INTO topics (title, category, numDuplicates, description)
              VALUES ('" . $_POST["title"] . "',
                      '" . $_POST["category"] . "',
                      '" . count($_FILES["images"]["name"]) . "',
                      '" . $description . "'
            );";
    if (mysql_query($cmd, $db_connection))
      $noticeText .= "Table 'topics' filled successfully.<br />";
    else
      $noticeText .= "Unable to fill table 'topics': " . mysql_error() . "<br />";
    
    // Retrieve topic ID
    $lastRecord = mysql_query("SELECT * FROM topics WHERE id = (SELECT MAX(id) FROM topics);", $db_connection);
    $lastRecordRow = mysql_fetch_array($lastRecord);
    $topicID = $lastRecordRow["id"];
    
    // Insert into 'images' table
    $valid_formats = array("jpg", "jpeg", "png");
    $max_file_size = 500000;
    $target_dir = "img/uploads/";
    
    foreach ($_FILES["images"]["name"] as $f => $name) {
      if ($_FILES["images"]["error"][$f] == 4) // if any error, skip file
        continue;
      if ($_FILES["images"]["error"][$f] == 0)
        if ($_FILES['images']['size'][$f] > $max_file_size) { // if too large, skip file
          $noticeText .= "$name is too large.<br />";
          continue;
        }
      	elseif (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)) { // if not correct image type, skip file
      		$noticeText .= "$name is not a valid format.<br />";
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

    // Insert into Table Group 1 ('majors', 'colleges', 'careers') and Table Group 2 ('major_topic', 'college_topic', and 'career_topic')
    $tables = array(array("major", "majors"), array("college", "colleges"), array("career", "careers"));
    for ($i = 0; $i < count($tables); $i++) {
      $singular = $tables[$i][0];
      $plural = $tables[$i][1];
      $cmd1 = "INSERT INTO " . $plural . " (name, url)"; // for Table Group 1
      $temp1 = "";
      $cmd2 = "INSERT INTO " . $singular . "_topic (" . $singular . "_name, topic_id)"; // for Table Group 2
      $temp2 = "";
      
      // Construct both temp strings
      for ($j = 1; $j < 6; $j++)
        if ($_POST[$singular . $j] != "") { // if name provided (the only requirement for Table Group 2)
          if ($_POST[$singular . $j . "_url"] != "" && mysql_num_rows(mysql_query("SELECT * FROM " . $plural . " WHERE name='" . $_POST[$singular . $j] . "';", $db_connection)) == 0) { // if url provided and no duplicates (additional for Table Group 1)
            if ($temp1 != "")
              $temp1 .= ",";
            $temp1 .= " ('" . $_POST[$singular . $j] . "','" . $_POST[$singular . $j . "_url"] . "')";
          }
          if ($temp2 != "")
            $temp2 .= ",";
          $temp2 .= " ('" . $_POST[$singular . $j] . "','" . $topicID . "')";
        }
      
      // if there are new entries, compile and execute the SQL command for Table Group 1
      if ($temp1 != "") {
        $cmd1 .= " VALUES" . $temp1 . ";";
        if (mysql_query($cmd1, $db_connection))
          $noticeText .= "Table '" . $plural . "' filled successfully.<br />";
        else
          $noticeText .= "Unable to fill table '" . $plural . "': " . mysql_error() . "<br />";
      }
      else
        $noticeText .= "Unable to fill table '" . $plural . "': No new " . $plural . " provided.<br />";
      
      // if there are new entries, compile and execute the SQL command for Table Group 2
      if ($temp2 != "") {
        $cmd2 .= " VALUES" . $temp2 . ";";
        if (mysql_query($cmd2, $db_connection))
          $noticeText .= "Table '" . $singular . "_topic' filled successfully.<br />";
        else
          $noticeText .= "Unable to fill table '" . $singular . "_topic': " . mysql_error() . "<br />";
      }
      else
        $noticeText .= "Unable to fill table '" . $singular . "_topic': No new " . $plural . " provided.<br />";
    }
  }
  else
    $noticeText .= "Unable to insert submission: Topic/Category combination already exists.";
?>