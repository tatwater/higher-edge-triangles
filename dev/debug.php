<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Connecticut College Design Public Practice Spring 2015" />
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <meta name="robots" content="noindex" />
    <link rel="stylesheet" href="styles.css" />
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <title>Admin | Project Polygon</title>
  </head>
  <?php include "includes/manage-db.php"; ?>
  <body>
    <div class="content admin">
<?php    
  // If 'topics' table has data, display remove form and topics table
  if ($topics_table = mysql_query("SELECT * FROM topics;", $db_connection)) {
?>
      <h3><br /><br />Topics</h3>
      <table>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Category</th>
          <th># of Duplicates</th>
          <th>Description</th>
        </tr>
<?php
    while ($row = mysql_fetch_array($topics_table)) {
      echo "        <tr>\n" .
           "          <td>" . $row['id'] . "</td>\n" .
           "          <td>" . $row['title'] . "</td>\n" .
           "          <td>" . $row['category'] . "</td>\n" .
           "          <td>" . $row['numDuplicates'] . "</td>\n" .
           "          <td>" . $row['description'] . "</td>\n" .
           "        </tr>\n";
    }
?>
      </table>
      <br />
<?php
  }
  
  // If 'images' table has data, display table
  if ($images_table = mysql_query("SELECT * FROM images;", $db_connection)) {
?>
      <p>Images</p>
      <table>
        <tr>
          <th>URL</th>
          <th>Topic ID</th>
        </tr>
<?php
  // Loop through 'images' table data
  while ($row = mysql_fetch_array($images_table))
    echo "        <tr>\n" .
         "          <td>" . $row['url'] . "</td>\n" .
         "          <td>" . $row['topic_id'] . "</td>\n" .
         "        </tr>\n";
?>
        </table>
        <br />
<?php
  }
  
  // If 'majors' table has data, display table
  if ($majors_table = mysql_query("SELECT * FROM majors;", $db_connection)) {
?>
      <p>Majors</p>
      <table>
        <tr>
          <th>Name</th>
          <th>URL</th>
        </tr>
<?php
  // Loop through 'majors' table data
  while ($row = mysql_fetch_array($majors_table))
    echo "        <tr>\n" .
         "          <td>" . $row['name'] . "</td>\n" .
         "          <td>" . $row['url'] . "</td>\n" .
         "        </tr>\n";
?>
        </table>
        <br />
<?php
  }
  
  // If 'colleges' table has data, display table
  if ($colleges_table = mysql_query("SELECT * FROM colleges;", $db_connection)) {
?>
      <p>Colleges</p>
      <table>
        <tr>
          <th>Name</th>
          <th>URL</th>
        </tr>
<?php
  // Loop through 'colleges' table data
  while ($row = mysql_fetch_array($colleges_table))
    echo "        <tr>\n" .
         "          <td>" . $row['name'] . "</td>\n" .
         "          <td>" . $row['url'] . "</td>\n" .
         "        </tr>\n";
?>
        </table>
        <br />
<?php
  }
  
  // If 'careers' table has data, display table
  if ($careers_table = mysql_query("SELECT * FROM careers;", $db_connection)) {
?>
      <p>Careers</p>
      <table>
        <tr>
          <th>Name</th>
          <th>URL</th>
        </tr>
<?php
  // Loop through 'careers' table data
  while ($row = mysql_fetch_array($careers_table))
    echo "        <tr>\n" .
         "          <td>" . $row['name'] . "</td>\n" .
         "          <td>" . $row['url'] . "</td>\n" .
         "        </tr>\n";
?>
        </table>
        <br />
<?php
  }
  
  // If 'major_topic' table has data, display table
  if ($major_topic_table = mysql_query("SELECT * FROM major_topic;", $db_connection)) {
?>
      <p>Major_Topic</p>
      <table>
        <tr>
          <th>Major Name</th>
          <th>Topic ID</th>
        </tr>
<?php
  // Loop through 'major_topic' table data
  while ($row = mysql_fetch_array($major_topic_table))
    echo "        <tr>\n" .
         "          <td>" . $row['major_name'] . "</td>\n" .
         "          <td>" . $row['topic_id'] . "</td>\n" .
         "        </tr>\n";
?>
        </table>
        <br />
<?php
  }
  
  // If 'college_topic' table has data, display table
  if ($college_topic_table = mysql_query("SELECT * FROM college_topic;", $db_connection)) {
?>
      <p>College_Topic</p>
      <table>
        <tr>
          <th>College Name</th>
          <th>Topic ID</th>
        </tr>
<?php
  // Loop through 'career_topic' table data
  while ($row = mysql_fetch_array($college_topic_table))
    echo "        <tr>\n" .
         "          <td>" . $row['college_name'] . "</td>\n" .
         "          <td>" . $row['topic_id'] . "</td>\n" .
         "        </tr>\n";
?>
        </table>
        <br />
<?php
  }
  
  // If 'career_topic' table has data, display table
  if ($career_topic_table = mysql_query("SELECT * FROM career_topic;", $db_connection)) {
?>
      <p>Career_Topic</p>
      <table>
        <tr>
          <th>Career Name</th>
          <th>Topic ID</th>
        </tr>
<?php
  // Loop through 'career_topic' table data
  while ($row = mysql_fetch_array($career_topic_table))
    echo "        <tr>\n" .
         "          <td>" . $row['career_name'] . "</td>\n" .
         "          <td>" . $row['topic_id'] . "</td>\n" .
         "        </tr>\n";
?>
        </table>
        <br />
<?php
  }
?>
    </div>
  </body>
</html>