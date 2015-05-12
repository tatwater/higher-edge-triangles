<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Connecticut College Design Public Practice Spring 2015" />
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <meta name="robots" content="noindex" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/vendor/slick.js"></script>
    <script src="js/scripts.js"></script>
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <title>Admin | Project Polygon</title>
  </head>
  <?php include "includes/manage-db.php"; ?>
  <body>
    <div style="background: rgba(0, 0, 0, .5); padding: 10px; position: absolute; top: 0; left: 0; z-index: 10;">
      <p><?php echo $noticeText; ?></p>
    </div>
    <div class="content">
      <h2>Admin Panel</h2>
      <form action="admin.php" enctype="multipart/form-data" method="post">
        <input name="title" placeholder="Title" type="text" required />
        <select name="category" required>
          <option value="">Select a Category...</option>
          <option value="My dream is">My dream is</option>
          <option value="My favorite class is">My favorite class is</option>
          <option value="My hobbies are">My hobbies are</option>
        </select>
        <textarea name="description" placeholder="Description" required></textarea>
        <input accept="image/*" multiple="multiple" name="images[]" type="file" required />
        <input name="major1" placeholder="Major 1" type="text" />
        <input name="major1_url" placeholder="Major 1 URL" type="url" />
        <input name="major2" placeholder="Major 2" type="text" />
        <input name="major2_url" placeholder="Major 2 URL" type="url" />
        <input name="major3" placeholder="Major 3" type="text" />
        <input name="major3_url" placeholder="Major 3 URL" type="url" />
        <input name="major4" placeholder="Major 4" type="text" />
        <input name="major4_url" placeholder="Major 4 URL" type="url" />
        <input name="major5" placeholder="Major 5" type="text" />
        <input name="major5_url" placeholder="Major 5 URL" type="url" />
        <input name="college1" placeholder="College 1" type="text" />
        <input name="college1_url" placeholder="College 1 URL" type="url" />
        <input name="college2" placeholder="College 2" type="text" />
        <input name="college2_url" placeholder="College 2 URL" type="url" />
        <input name="college3" placeholder="College 3" type="text" />
        <input name="college3_url" placeholder="College 3 URL" type="url" />
        <input name="college4" placeholder="College 4" type="text" />
        <input name="college4_url" placeholder="College 4 URL" type="url" />
        <input name="college5" placeholder="College 5" type="text" />
        <input name="college5_url" placeholder="College 5 URL" type="url" />
        <input name="career1" placeholder="Career 1" type="text" />
        <input name="career1_url" placeholder="Career 1 URL" type="url" />
        <input name="career2" placeholder="Career 2" type="text" />
        <input name="career2_url" placeholder="Career 2 URL" type="url" />
        <input name="career3" placeholder="Career 3" type="text" />
        <input name="career3_url" placeholder="Career 3 URL" type="url" />
        <input name="career4" placeholder="Career 4" type="text" />
        <input name="career4_url" placeholder="Career 4 URL" type="url" />
        <input name="career5" placeholder="Career 5" type="text" />
        <input name="career5_url" placeholder="Career 5 URL" type="url" />
        <input name="insert" type="submit" value="Add record" />
      </form>
<?php
  // If 'topics' table has data, display table
  if ($topics_table = mysql_query("SELECT * FROM topics;", $db_connection)) {
?>
      <br />
      <p>Topics</p>
      <table>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Category</th>
          <th># of Duplicates</th>
          <th>Description</th>
        </tr>
<?php
  // Loop through 'topics' table data
  while ($row = mysql_fetch_array($topics_table))
    echo "        <tr>\n" .
         "          <td>" . $row['id'] . "</td>\n" .
         "          <td>" . $row['title'] . "</td>\n" .
         "          <td>" . $row['category'] . "</td>\n" .
         "          <td>" . $row['numDuplicates'] . "</td>\n" .
         "          <td>" . $row['description'] . "</td>\n" .
         "        </tr>\n";
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
  <?php mysql_close($db_connection); ?>
</html>