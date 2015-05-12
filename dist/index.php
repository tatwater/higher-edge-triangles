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
  <?php include "includes/load-data.php"; ?>
  <body data-topic-id="<?php echo $topicID; ?>">
    <ul class="triangle-corner">
<?php
  // Print list of <li>s for traingles, 23|18 with|without white
  for ($i = 0; $i < 23; $i++)
    echo "      <li></li>\n";
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
  // List all majors
  for ($i = 0; $i < count($majorData); $i++)
    echo "              <li><a href='" . $majorData[$i][1] . "'>" . $majorData[$i][0] . "</a></li>\n";
?>
            </ul>
          </div>
          <div class="col">
            <h3>Colleges</h3>
            <ul>
<?php
  // List all colleges
  for ($i = 0; $i < count($collegeData); $i++)
    echo "              <li><a href='" . $collegeData[$i][1] . "'>" . $collegeData[$i][0] . "</a></li>\n";
?>
            </ul>
          </div>
          <div class="col">
            <h3>Careers</h3>
            <ul>
<?php
  // List all careers
  for ($i = 0; $i < count($careerData); $i++)
    echo "              <li><a href='" . $careerData[$i][1] . "'>" . $careerData[$i][0] . "</a></li>\n";
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
            <ul class="tag-cloud">
<?php
  // Make colored tags for all topics
  if ($topics_table = mysql_query("SELECT * FROM topics;", $db_connection))
    while ($topic = mysql_fetch_array($topics_table))
      echo "              <li data-color='" . $topic['category'] . "'><a href='?topic_id=" . $topic['id'] . "'>" . $topic['title'] . "</a></li>\n";
?>
            </ul>
          </div>
        </div>
      </div>
      <button class="down-arrow" data-toggle="intro"></button>
      <button class="toggle-zone" data-toggle="intro"></button>
    </section>
  </body>
  <?php mysql_close($db_connection); ?>
</html>