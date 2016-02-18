# Delicious2MySQL
__*An easy PHP script to backup all your [delicious.com](https://delicious.com) links to a MySQL database*__.

## Installation
* Download the latest release of Delicious2MySQL from https://github.com/mstuyts/Delicious2MySQL/releases/latest
* Extract the archive file
* Copy all files from the archive to your webserver. We'll assume you upload them to a folder named 'links' in your root folder. This way you'll end up with Delicious2MySQL on http://yourdomain.com/links/. 
* In your browser go to the url http://yourdomain.com/links/ and it will redirect you to the install script.
* Fill in the necessary settings and click Save Settings.

## Sync your links
* If you followed the installation instructions everything is set and you're ready to sync!
* Go to http://yourdomain.com/links/sync.php to download your links to the MySQL database.

## See the synced links
* Go to http://yourdomain.com/links/ to see your links.

## Requirements
* An account at https://delicious.com (it's free) with links
* A MySQL database
* A webserver (shared hosting is just fine): PHP 5.2 or higher with cURL support on your webserver

## Good to know
* If you want to keep your database up to date set up a cron job to wget http://yourdomain.com/links/sync.php or visit that page frequently.
* Every time you sync your links and the server is able to get your links from [delicious.com](https://delicious.com), the script empties the MySQL table and fills it with your current links on [delicious.com](https://delicious.com).
* **Important!** Please wait at least one second between synchronisations, or you are likely to get automatically throttled by (https://delicious.com). 
* The [delicious.com](https://delicious.com) allows to sync your latest 100000 links. If you have more links than that, you will loose older links.

## Demo
* Frontpage: https://michelstuyts.be/links/
* Page to sync links: https://michelstuyts.be/links/sync.php