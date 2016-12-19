# Delicious2MySQL
__*An easy PHP script to backup your [delicious.com](https://delicious.com) links to a MySQL database.*__


| **<h2> delicious.com killed their API. This means this script has to use the JSON feed provided by delicious.com. This feed only shows the 100 most recent public links. If you open the link to sync.php frequent enough, you can backup all new links to MySQL. Links removed from your delcious.com account won't be deleted from your MySQL database.</h2>** |
|-----|

## Requirements
* A username at https://delicious.com with links;
* A MySQL database;
* A webserver (shared hosting is just fine): PHP 5.2 or higher with cURL support on your webserver.

## Installation
* Download the latest release of Delicious2MySQL from https://github.com/mstuyts/Delicious2MySQL/releases/latest.
* Extract the archive file.
* Copy all files from the archive to your webserver. We'll assume you upload them to a folder named 'links' in your root folder. This way you'll end up with Delicious2MySQL on https://yourdomain.com/links/. 
* In your browser go to the url https://yourdomain.com/links/ and it will redirect you to the install script.
* Fill in the necessary settings and click Save Settings.

## Backup your links
* If you followed the installation instructions everything is set and you're ready to backup!
* Go to https://yourdomain.com/links/sync.php to download your links to the MySQL database.

## See the backed up links
* Go to https://yourdomain.com/links/ to see your links.

## Good to know
* If you want to keep your database up to date set up a cron job to wget https://yourdomain.com/links/sync.php or visit that page frequently.
* Every time you backup your links and the server is able to get your links from [delicious.com](https://delicious.com), the script adds the new links to the MySQL table and fills it with your current links on [delicious.com](https://delicious.com).
* The [delicious.com](https://delicious.com) feed allows to backup your latest 100 links. If you have more links than that, older links are not saved to the MySQL database. Existing links in the database won't be deleted.
* Run sync.php 

## Demo
* Frontpage: https://michelstuyts.be/links/
* Page to sync links: https://michelstuyts.be/links/sync.php
