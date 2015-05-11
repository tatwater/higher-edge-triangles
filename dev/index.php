<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Connecticut College Design Public Practice Spring 2015" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/vendor/slick.js"></script>
    <script src="js/scripts.js"></script>
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <title>Project Polygon</title>
  </head>
  <?php
    include "includes/manage-db.php";
    include "includes/load-data.php";
    
    $noticeText = "";
    mysql_select_db("project_polygon", $db_connection);
    
    $lastRecord = mysql_query("SELECT * FROM topics WHERE id = (SELECT MAX(id) FROM topics);", $db_connection);
    $last = mysql_fetch_array($lastRecord);
    $numTopics = $last["id"];
    
    if (isset($_GET["topic_id"]))
      $topicID = $_GET["topic_id"];
    else
      $topicID = rand(1, $numTopics);
    
    $topicData = mysql_fetch_array(mysql_query("SELECT * FROM topics WHERE id = '" . $topicID . "';", $db_connection));
    
    $firstImageData = mysql_fetch_array(mysql_query("SELECT * FROM images WHERE topic_id = '" . $topicID . "' LIMIT 1;", $db_connection));
    
    $majorData = array();
    $temp = mysql_query("SELECT * FROM major_topic WHERE topic_id = '" . $topicID . "';", $db_connection);
    while ($majorTopicRow = mysql_fetch_array($temp)) {
      $temp2 = mysql_query("SELECT * FROM majors WHERE name = '" . $majorTopicRow["major_name"] . "';", $db_connection);
      while ($majorRow = mysql_fetch_array($temp2)) {
        array_push($majorData, array($majorRow["name"], $majorRow["url"]));
      }
    }
    
    $collegeData = array();
    $temp = mysql_query("SELECT * FROM college_topic WHERE topic_id = '" . $topicID . "';", $db_connection);
    while ($collegeTopicRow = mysql_fetch_array($temp)) {
      $temp2 = mysql_query("SELECT * FROM colleges WHERE name = '" . $collegeTopicRow["college_name"] . "';", $db_connection);
      while ($collegeRow = mysql_fetch_array($temp2)) {
        array_push($collegeData, array($collegeRow["name"], $collegeRow["url"]));
      }
    }
    
    $careerData = array();
    $temp = mysql_query("SELECT * FROM career_topic WHERE topic_id = '" . $topicID . "';", $db_connection);
    while ($careerTopicRow = mysql_fetch_array($temp)) {
      $temp2 = mysql_query("SELECT * FROM careers WHERE name = '" . $careerTopicRow["career_name"] . "';", $db_connection);
      while ($careerRow = mysql_fetch_array($temp2)) {
        array_push($careerData, array($careerRow["name"], $careerRow["url"]));
      }
    }
  ?>
  <body>
    <ul class="triangle-corner">
<?php
for ($i = 0; $i < 23; $i++) { // 18 without white, 23 with
  echo "      <li></li>\n";
}
?>
    </ul>
    <div class="logo">
      <a href="http://higheredgect.org/"><img src="img/logo.png" /></a>
    </div>
    <section class="content">
      <div class="row two">
        <div class="col">
          <div class="category-title">
            <a href="?topic_id=<?php echo ($topicID + $numTopics - 2) % $numTopics + 1; ?>"><span class="arrow up"></span></a>
            <p class="subhead" data-color="<?php echo $topicData["category"]; ?>"><?php echo $topicData["category"]; ?></p>
            <h1><?php echo $topicData["title"]; ?></h1>
            <p><?php echo $topicData["numDuplicates"] . " student";
                     if ($topicData["numDuplicates"] != 1)
                       echo "s"; ?></p>
            <p><?php echo $noticeText; ?></p>
            <a href="?topic_id=<?php echo ($topicID + $numTopics) % $numTopics + 1; ?>"><span class="arrow down"></span></a>
          </div>
        </div>
        <div class="col">
          <div class="gallery">
            <img src="img/uploads/<?php echo $firstImageData["url"]; ?>" />
          </div>
        </div>
      </div>
    </section>
    <section class="info">
      <button class="close">X</button>
      <div class="content">
        <p class="subhead"><?php echo $topicData["category"]; ?></p>
        <h1><?php echo $topicData["title"]; ?></h1>
        <p><?php echo $topicData["description"]; ?></p>
        <div class="row three">
          <div class="col">
            <h3>Majors</h3>
            <ul>
<?php
  for ($i = 0; $i < 5; $i++) {
    echo "              <li><a href='" . $majorData[$i][1] . "'>" . $majorData[$i][0] . "</a></li>\n";
  }
?>
            </ul>
          </div>
          <div class="col">
            <h3>Colleges</h3>
            <ul>
<?php
  for ($i = 0; $i < 5; $i++) {
    echo "              <li><a href='" . $collegeData[$i][1] . "'>" . $collegeData[$i][0] . "</a></li>\n";
  }
?>
            </ul>
          </div>
          <div class="col">
            <h3>Careers</h3>
            <ul>
<?php
  for ($i = 0; $i < 5; $i++) {
    echo "              <li><a href='" . $careerData[$i][1] . "'>" . $careerData[$i][0] . "</a></li>\n";
  }
?>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section class="intro">
      <button class="close" data-toggle="intro">X</button>
      <div class="content">
        <div class="row two">
          <div class="col">
            <h2>Project Polygon</h2>
            <p>Project description paragraph here, stating purpose and connection to Conn. Project description paragraph here, stating purpose and connection to Conn. Project description paragraph here, stating purpose and connection to Conn.</p>
            <a class="button" href="http://designpublicpractice.org/">Learn More &raquo;</a>
          </div>
          <div class="col">
            <div class="tag-cloud">
<?php
//  $topics_table = mysql_query("SELECT * FROM topics;", $db_connection);
  if ($topics_table) {
    while ($row = mysql_fetch_array($topics_table)) {
      echo "              <span data-color='" . $row['category'] . "'><a href='?topic_id=" . $row['id'] . "'>" . $row['title'] . "</a></span>\n";
    }
  }
?>
<!--              <span class="blue"><a href="">History</a></span>
              <span class="purple"><a href="">Dance</a></span>
              <span class="blue"><a href="">Engineering</a></span>
              <span class="green"><a href="">Math</a></span>
              <span class="blue"><a href="">Politics</a></span>
              <span class="green"><a href="">Computer Science</a></span>
              <span class="purple"><a href="">Design</a></span>
              <span class="purple"><a href="">Business</a></span>
              <span class="green"><a href="">Medicine</a></span>
              <span class="blue"><a href="">History</a></span>
              <span class="purple"><a href="">Dance</a></span>
              <span class="blue"><a href="">Engineering</a></span>
              <span class="green"><a href="">Math</a></span>
              <span class="blue"><a href="">Politics</a></span>
              <span class="green"><a href="">Computer Science</a></span>
              <span class="purple"><a href="">Design</a></span>
              <span class="purple"><a href="">Business</a></span>
              <span class="green"><a href="">Medicine</a></span>
              <span class="blue"><a href="">History</a></span>
              <span class="purple"><a href="">Dance</a></span>
              <span class="blue"><a href="">Engineering</a></span>
              <span class="green"><a href="">Math</a></span>
              <span class="blue"><a href="">Politics</a></span>
              <span class="green"><a href="">Computer Science</a></span>
              <span class="purple"><a href="">Design</a></span>
              <span class="purple"><a href="">Business</a></span>
              <span class="green"><a href="">Medicine</a></span>
              <span class="blue"><a href="">History</a></span>
              <span class="purple"><a href="">Dance</a></span>-->
            </div>
          </div>
        </div>
      </div>
      <button class="down-arrow" data-toggle="intro"></button>
      <button class="toggle-zone" data-toggle="intro"></button>
    </section>
  </body>
</html>