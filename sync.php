<?php
clearstatcache();
$settingsfile='includes/settings.php';
$savesettingsfile='savesettings.php';
if(!file_exists($settingsfile)){
<<<<<<< HEAD
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
    <meta name="description" content="Delicious2MySQL: A script to backup all your Delicious links.">
    <title>Delicious2MySQL - Sync all links</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div id="wrapper">
      <h1>Sync links with Delicious2MySQL</h1>
      <p id="intro">This page backups the last 100 links of user '<?php echo($deluser);?>' on Delicious.com to MySQL.</p>
      <?php
        // Connect to database
        error_reporting(0);
        $mysqli=new mysqli($dbhost, $dbuser, $dbpassword, $db);
        if(mysqli_connect_errno()) {
          echo('<h2>Problem to connect to MySQL</h2><p>Connection to MySQL failed: ' . mysqli_connect_error().'. </p>');
          die();
        }
        // Get data from delicious.com
        $ch=curl_init();
        $jsonurl="http://feeds.del.icio.us/v2/json/".$deluser."?count=100";
        $headers = array("POST ".$page." HTTP/1.0","Content-type: text/xml;charset=\"utf-8\"","Accept: text/xml", "Cache-Control: no-cache","Pragma: no-cache","SOAPAction: \"run\"");
        $url="{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        curl_setopt($ch, CURLOPT_URL, $jsonurl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT,'Delicious2MySQL on '.$url);
        $checkarray = json_decode(curl_exec($ch),TRUE);
        curl_close($ch);

        if(!is_array($checkarray)){
          echo('<h2>Connection to Delicious.com failed.</h2>');
        }
        else{
          // Get all existing links
          $selectquery="SELECT * FROM ".$linkstable;
          $dblinks=$mysqli->query($selectquery);
          $numberoflinks = $dblinks->num_rows;
          if($numberoflinks==0){
               echo("<p id='intro'>There are no links in your existing database.</p>");

          }
          else{
                while ($row = mysqli_fetch_array($dblinks)) {
                   $checkurl[$row["url"]] = $row["url"];
                }
          }

          // Count the number of links (max. 100 due to feed limits)
          $countlinks=count($checkarray);
          echo("<p>Number of links to be checked: $countlinks</p>");
          // Create MySQL query
          $insertsql="INSERT INTO ".$linkstable." (url, description, notes, tags, updated) VALUES ";
          $countnewlinks=0;
          foreach($checkarray as $linkrecord){
              if($checkurl[$linkrecord['u']]!=$linkrecord['u']){
                  $taglist="";
                  foreach($linkrecord['t'] as $tag){
                      $taglist.=$tag.",";
                  }
                  if(substr($taglist,-1,1)==","){$taglist=substr($taglist,0,-1);}
                  $insertsql.="('".$linkrecord['u']."', '".$mysqli->real_escape_string($linkrecord['n'])."', '".addslashes(htmlentities(utf8_decode($linkrecord['d'])))."', '".addslashes(htmlentities(utf8_decode($taglist)))."', '".$linkrecord['dt']."'),";
                  $countnewlinks++;
              }
          }
          $insertsql=substr($insertsql,0,-1);
          $insertsql.=";";
            if($countnewlinks>0){
              // Add all new links to MySQL
              if ($mysqli->query($insertsql) === TRUE) {
                echo("<p>$countnewlinks link(s) were copied to the MySQL table. Go to the <a href='.'>frontpage</a> to see them.</p>");
              } else {
                echo('<p>Unable to add data to MySQL table: ' . mysqli_connect_error().'. </p>');
              }
            }
            else{
                echo("<p>There were no new links.</p>");
            }
        }
      ?>
    </div>
        <?php
            include_once("footer.php");
        ?>
  </body>
=======
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
		<meta name="description" content="Delicious2MySQL: A script to backup all your Delicious links.">
		<title>Delicious2MySQL - Sync all links</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div id="wrapper">
			<h1>Sync links with Delicious2MySQL</h1>
			<p id="intro">This page backups the last 100000 links of user '<?php echo($deluser);?>' on Delicious.com to MySQL.</p>
			<?php
				// Connect to database
				error_reporting(0);
				$mysqli=new mysqli($dbhost, $dbuser, $dbpassword, $db);
				if(mysqli_connect_errno()) {
					echo('<h2>Problem to connect to MySQL</h2><p>Connection to MySQL failed: ' . mysqli_connect_error().'. </p>');
					die();
				}
				// Check if Delicious.com settings are correct
				$ch=curl_init();
				$api="https://api.del.icio.us/v1/posts/all?&results=100000&tag_separator=comma";
				$credentials = $deluser.':'.$delpassword;
				$headers = array("POST ".$page." HTTP/1.0","Content-type: text/xml;charset=\"utf-8\"","Accept: text/xml", "Cache-Control: no-cache","Pragma: no-cache","SOAPAction: \"run\"","Authorization: Basic " . base64_encode($credentials));
                $url="{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
				curl_setopt($ch, CURLOPT_URL, $api);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_USERAGENT,'Delicious2MySQL on '.$url);
				$checkarray = json_decode(json_encode(simplexml_load_string(curl_exec($ch))),TRUE);
				curl_close($ch);
				if($checkarray['@attributes']['user']!=$deluser){
					echo('<h2>Connection to Delicious.com failed.</h2>');
				}
				else{
					// Empty the existing MySQL table
					$emptyquery="TRUNCATE ".$linkstable;
					$mysqli->query($emptyquery);
					// Get all links in an array
					$linksarray=$checkarray['post'];
					// Count the number of links (max. 100000 due to API limits)
					$countlinks=count($linksarray);
					echo("<p>Number of links to be synced: $countlinks</p>");
					// Create MySQL query
					$insertsql="INSERT INTO ".$linkstable." (url, description, notes, tags, private, hash, updated) VALUES ";
					foreach($linksarray as $linkdataset){
							$linkrecord=$linkdataset['@attributes'];
							$insertsql.="('".$linkrecord['href']."', '".$mysqli->real_escape_string($linkrecord['description'])."', '".addslashes(htmlentities(utf8_decode($linkrecord['extended'])))."', '".addslashes(htmlentities(utf8_decode($linkrecord['tag'])))."', '".$linkrecord['private']."', '".$linkrecord['hash']."', '".$linkrecord['time']."'),";
					}
					$insertsql=substr($insertsql,0,-1);
					$insertsql.=";";
					// Add all the links to MySQL
					if ($mysqli->query($insertsql) === TRUE) {
						echo("<p>All links were copied to the MySQL table. Go to the <a href='.'>frontpage</a> to see them.</p>");
					} else {
						echo('<p>Unable to add data to MySQL table: ' . mysqli_connect_error().'. </p>');
					}
				}
			?>
		</div>
        <?php
            include_once("footer.php");
        ?>
	</body>
>>>>>>> Delicious2MySQL/master
</html>
