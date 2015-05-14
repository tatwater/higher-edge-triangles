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
    <div class="content admin">
      <nav class="form-switch">
        <button <?php if (!isset($_POST["edit"]) && !isset($_POST["delete"])) { echo 'class="active"'; } ?> data-toggle="insert" type="button">Insert <span>New Record</span></button>
        <button <?php if (isset($_POST["edit"])) { echo 'class="active"'; } ?> data-toggle="edit" type="button">Edit <span>Existing Record</span></button>
        <button <?php if (isset($_POST["delete"])) { echo 'class="active"'; } ?> data-toggle="delete" type="button">Delete <span>Existing Record</span></button>
<?php if ($noticeText != "") {
          echo "        <div>" .
               "          <button data-hide='noticeText'>X</button>" .
               "          <p>" . $noticeText . "</p>" .
               "        </div>";
      }
?>
      </nav>
      
      <form action="admin.php" data-name="insert" enctype="multipart/form-data" method="post">
        <h3>Basic Info</h3>
        <div class="row two">
          <div class="col">
            <input name="title" placeholder="Title" type="text" required />
          </div>
          <div class="col">
            <select name="category" required>
              <option value="">Select a Category...</option>
              <option value="My dream is">My dream is</option>
              <option value="My favorite class is">My favorite class is</option>
              <option value="My hobbies are">My hobbies are</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <textarea name="description" placeholder="Description" required></textarea>
            <input accept="image/*" multiple="multiple" name="images[]" type="file" required />
          </div>
        </div>
        <h3>Majors</h3>
        <div class="row two">
          <div class="col pair">
            <input name="major1" placeholder="Major 1" type="text" />
            <input name="major1_url" placeholder="Major 1 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="major2" placeholder="Major 2" type="text" />
            <input name="major2_url" placeholder="Major 2 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="major3" placeholder="Major 3" type="text" />
            <input name="major3_url" placeholder="Major 3 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="major4" placeholder="Major 4" type="text" />
            <input name="major4_url" placeholder="Major 4 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="major5" placeholder="Major 5" type="text" />
            <input name="major5_url" placeholder="Major 5 URL" type="url" />
          </div>
        </div>
        <h3>Colleges</h3>
        <div class="row two">
          <div class="col pair">
            <input name="college1" placeholder="College 1" type="text" />
            <input name="college1_url" placeholder="College 1 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="college2" placeholder="College 2" type="text" />
            <input name="college2_url" placeholder="College 2 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="college3" placeholder="College 3" type="text" />
            <input name="college3_url" placeholder="College 3 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="college4" placeholder="College 4" type="text" />
            <input name="college4_url" placeholder="College 4 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="college5" placeholder="College 5" type="text" />
            <input name="college5_url" placeholder="College 5 URL" type="url" />
          </div>
        </div>
        <h3>Careers</h3>
        <div class="row two">
          <div class="col pair">
            <input name="career1" placeholder="Career 1" type="text" />
            <input name="career1_url" placeholder="Career 1 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="career2" placeholder="Career 2" type="text" />
            <input name="career2_url" placeholder="Career 2 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="career3" placeholder="Career 3" type="text" />
            <input name="career3_url" placeholder="Career 3 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="career4" placeholder="Career 4" type="text" />
            <input name="career4_url" placeholder="Career 4 URL" type="url" />
          </div>
          <div class="col pair">
            <input name="career5" placeholder="Career 5" type="text" />
            <input name="career5_url" placeholder="Career 5 URL" type="url" />
          </div>
        </div>
        <h3>Authorize</h3>
        <div class="row two">
          <div class="col">
            <input name="password" placeholder="Password" type="password" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input name="insert" type="submit" value="Add record" />
          </div>
        </div>
      </form>
      
      <form action="" data-name="edit" method="">
        <div class="row two">
          <div class="col">
            <h3>Choose</h3>
            <select name="topic_id" required>
              <option value="">Select a Record...</option>
    <?php
      // If 'topics' table has data, display remove form and topics table
      if ($topics_table = mysql_query("SELECT * FROM topics;", $db_connection)) {
        
        // Loop through 'topics' table data
        while ($row = mysql_fetch_array($topics_table)) {
          echo '          <option value="' . $row["id"] . '">' . $row["title"] . ' (' . $row["category"] . ')</option>';
        }
      }
    ?>
            </select>
          </div>
          <div class="col">
            <h3>Authorize</h3>
            <input name="password" placeholder="Password" type="password" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input name="edit" type="submit" value="Edit record (Coming Soon)" />
          </div>
        </div>
      </form>
      
      <form action="admin.php" data-name="delete" method="post">
        <div class="row two">
          <div class="col">
            <h3>Choose</h3>
            <select name="topic_id" required>
              <option value="">Select a Record...</option>
    <?php
      // If 'topics' table has data, display remove form and topics table
      if ($topics_table = mysql_query("SELECT * FROM topics;", $db_connection)) {
        
        // Loop through 'topics' table data
        while ($row = mysql_fetch_array($topics_table)) {
          echo '          <option value="' . $row["id"] . '">' . $row["title"] . ' (' . $row["category"] . ')</option>';
        }
      }
    ?>
            </select>
          </div>
          <div class="col">
            <h3>Authorize</h3>
            <input name="password" placeholder="Password" type="password" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input name="delete" type="submit" value="Delete record" />
          </div>
        </div>
      </form>
    </div>
  </body>
  <?php mysql_close($db_connection); ?>
</html>