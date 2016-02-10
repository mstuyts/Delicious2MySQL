<?php
clearstatcache();
$settingsfile='includes/settings.php';
$savesettingsfile='savesettings.php';
if(file_exists($settingsfile)){
	header('Location: index.php');
	if(file_exists($savesettingsfile)){
		unlink($savesettingsfile);
	}
    die();
}
if(!file_exists($savesettingsfile)){
	echo('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content="Problem to install the Delicious2MySQL script."><title>Problem to Install Delicious2MySQL</title><link rel="stylesheet" href="css/style.css"></head><body><div id="wrapper"><h1>Problem to Install Delicious2MySQL</h1><p id="intro">The file '.$savesettingsfile.' has been removed for security reasons. Put it back on your server to install this script.</p></div></body></html>');
     die();
}
?><!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Install the Delicious2MySQL script.">
		<title>Install Delicious2MySQL</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div id="wrapper">
			<h1>Install Delicious2MySQL</h1>
			<p id="intro">Fill in the settings below to install Delicious2MySQL.</p>
			<form action="savesettings.php" method="post">
				<h2>MySQL Settings</h2>
				<p><span class="inputtext">Database host:</span><input type="text" size="35" name="dbhost" value="localhost"></p>
				<p><span class="inputtext">Database name:</span><input type="text" size="35" name="db" value=""></p>
				<p><span class="inputtext">Database user:</span><input type="text" size="35" name="dbuser" value=""></p>
				<p><span class="inputtext">Database password:</span><input type="text" size="35" name="dbpassword" value=""></p>
				<p><span class="inputtext">Database tables prefix:</span><input type="text" size="35" name="tableprefix" value="delicious_"></p>
				<h2>Delicious.com settings</h2>
				<p><span class="inputtext">Delicious.com username:</span><input type="text" size="35" name="deluser" value=""></p>
				<p><span class="inputtext">Delicious.com password:</span><input type="text" size="35" name="delpassword" value=""></p>
				<p id="submitbutton"><input type="submit" value="Save settings"></p>
			</form>
		</div>
	</body>
</html>
