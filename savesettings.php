<?php
$settingsfile='includes/settings.php';
$savesettingsfile='savesettings.php';
if(file_exists($settingsfile)){
	 header('Location: index.php');
	 unlink($savesettingsfile);
     die();
}
// Check if everything is filled in
if($_POST['dbhost']=="" || $_POST['db']=="" || $_POST['dbuser']=="" || $_POST['dbpassword']=="" || $_POST['tableprefix']=="" || $_POST['deluser']=="" || $_POST['delpassword']=="" ){
	echo('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content="Problem to install the Delicious2MySQL script."><title>Problem to Install Delicious2MySQL</title><link rel="stylesheet" href="css/style.css"></head><body><div id="wrapper"><h1>Problem to Install Delicious2MySQL</h1><p id="intro">Not all settings were filled in. Go back and correct your settings.</p><p id="submitbutton"><input type="button" onclick="window.history.back();" value="Go Back"></p></div></body></html>');
	die();
}
// Check if MySQL settings are correct
error_reporting(0);
$mysqli = new mysqli($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpassword'], $_POST['db']);
if(mysqli_connect_errno()) {
	echo('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content="Problem to install the Delicious2MySQL script."><title>Problem to Install Delicious2MySQL</title><link rel="stylesheet" href="css/style.css"></head><body><div id="wrapper"><h1>Problem to Install Delicious2MySQL</h1><p id="intro">Connection to MySQL failed: ' . mysqli_connect_error().'. Please go back and correct your MySQL settings.</p><p id="submitbutton"><input type="button" onclick="window.history.back();" value="Go Back"></p></div></body></html>');
	die();
}
// Check if Delicious.com settings are correct
$ch = curl_init();
$api="https://api.del.icio.us/v1/posts/all&results=1";
$credentials = $_POST['deluser'].':'.$_POST['delpassword'];
$headers = array("POST ".$page." HTTP/1.0","Content-type: text/xml;charset=\"utf-8\"","Accept: text/xml", "Cache-Control: no-cache","Pragma: no-cache","SOAPAction: \"run\"","Authorization: Basic " . base64_encode($credentials));
curl_setopt($ch, CURLOPT_URL, $api);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$checkarray = json_decode(json_encode(simplexml_load_string(curl_exec($ch))),TRUE);
curl_close($ch);
if($checkarray['@attributes']['code']=="access denied"){
	echo('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content="Problem to install the Delicious2MySQL script."><title>Problem to Install Delicious2MySQL</title><link rel="stylesheet" href="css/style.css"></head><body><div id="wrapper"><h1>Problem to Install Delicious2MySQL</h1><p id="intro">Connection to Delicious.com failed. Please go back and correct your Delicious.com settings.</p><p id="submitbutton"><input type="button" onclick="window.history.back();" value="Go Back"></p></div></body></html>');
	die();
}
// Create MySQL tables
$droptablesql="DROP TABLE IF EXISTS ".$_POST['tableprefix']."links;";
if ($mysqli->query($droptablesql) === TRUE) {
    // Table dropped successfully
} else {
    	echo('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content="Problem to install the Delicious2MySQL script."><title>Problem to Install Delicious2MySQL</title><link rel="stylesheet" href="css/style.css"></head><body><div id="wrapper"><h1>Problem to Install Delicious2MySQL</h1><p id="intro">Unable to drop MySQL table: ' . mysqli_connect_error().'. Please go back and correct your MySQL settings.</p><p id="submitbutton"><input type="button" onclick="window.history.back();" value="Go Back"></p></div></body></html>');
	die();
}
$createtablesql="CREATE TABLE ".$_POST['tableprefix']."links ( url varchar(250) , description varchar(250) , notes text, tags text, hash varchar(50) , updated longtext);";
if ($mysqli->query($createtablesql) === TRUE) {
    // Table created successfully
} else {
    	echo('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content="Problem to install the Delicious2MySQL script."><title>Problem to Install Delicious2MySQL</title><link rel="stylesheet" href="css/style.css"></head><body><div id="wrapper"><h1>Problem to Install Delicious2MySQL</h1><p id="intro">Unable to create MySQL table: ' . mysqli_connect_error().'. Please go back and correct your MySQL settings.</p><p id="submitbutton"><input type="button" onclick="window.history.back();" value="Go Back"></p></div></body></html>');
	die();
}

// Save settings file
$settingsfile = fopen("includes/settings.php", "w") or die("Unable to open file!");
$setting = '<?php
// User settings
	//DB settings
	$dbhost="'.$_POST['dbhost'].'"; // The host of the MySQL database. Often: $dbhost="localhost";
	$db="'.$_POST['db'].'"; // The MySQL database
	$dbuser="'.$_POST['dbuser'].'"; // The MySQL user
	$dbpassword="'.$_POST['dbpassword'].'"; // The MySQL password
	$tableprefix="'.$_POST['tableprefix'].'"; // The prefix of the MySQL tables so they won\'t interfere with other apps on the same database. For example: $tableprefix="delicious_";

	// Delicious.com settings
	$deluser="'.$_POST['deluser'].'";
	$delpassword="'.$_POST['delpassword'].'";

// System settings
// DON\'T CHANGE ANYTHING AFTER THIS
	// DB settings
	$linkstable=$tableprefix."links";
?>';
fwrite($settingsfile, $setting);
fclose($settingsfile);
header('Location: index.php');
?>
