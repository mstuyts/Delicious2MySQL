<?php
clearstatcache();
$settingsfile='includes/settings.php';
$savesettingsfile='savesettings.php';
if(!file_exists($settingsfile)){
   header('Location: install.php');
     die();
}
else{
  if(file_exists($savesettingsfile)){
    unlink($savesettingsfile);
  }
}
include_once($settingsfile);
?><!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A backup of my del.icio.us links using Delicious2MySQL.">
    <title>My favourite links</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div id="wrapper">
      <h1>My favourite links</h1>
      <?php
        // Connect to database
        error_reporting(0);
        $mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $db);
        if(mysqli_connect_errno()) {
          echo('<h2>Problem to connect to MySQL</h2><p>Connection to MySQL failed: ' . mysqli_connect_error().'. </p>');
          die();
        }
        // Check if there are links in the database
        $dblinks=$mysqli->query("SELECT * FROM ".$linkstable." WHERE private='no' OR private IS NULL ORDER BY updated DESC");
        $numberoflinks = $dblinks->num_rows;

        if($numberoflinks==0){
          echo("<p id='intro'>There are no links in your database. You possibly didn't download them yet from Del.icio.us. To do so <a href='sync.php'>click here</a>.</p>");
        }
        else{
          if($numberoflinks>99999){
            echo("<p id='intro'>This page shows the last $numberoflinks public links of user '$deluser' on Delicious.com that are in the MySQL database.</p>");
          }else{
            echo("<p id='intro'>This page shows all $numberoflinks public links of user '$deluser' on Delicious.com that are in the MySQL database.</p>");
          }
          while ($row = mysqli_fetch_array($dblinks)) {
            $url = $row["url"];
            $description = $row["description"];
            $notes = $row["notes"];
            $tags = str_replace(',',', ', $row["tags"]);
            $hash = $row["hash"];
            $updated = $row["updated"];
                        echo("<p class='link'>");
                        echo("<a href='$url' target='_blank' alt='$hash'>$description</a> <span class='monospace'>($updated)</span>");
                        if($tags!="" or $notes!=""){echo("<br />");}
                        if($tags!=""){
                            echo("<strong>tags:</strong> <i>$tags</i>");
                        }
                        if($notes!=""){
                          if($tags!=""){echo(" - ");}
                            echo("<strong>notes:</strong> <i>$notes</i>");
                        }
                        echo("</p>");
          }
        }
      ?>
    </div>
        <?php
            include_once("footer.php");
        ?>
  </body>
</html>
