# Delicious2MySQL
__*An easy PHP script to backup all your [delicious.com](https://delicious.com) links to a MySQL database*__.

## Installation
* Copy all files from this repository to your webserver. We assume you upload them to a folder named 'links' in your root folder. This way you'll end up with Delicious2MySQL in http://yourdomain.com/links/. 
* In your browser you go to the url http://yourdomain.com/links/.
* Fill in the necessary settings and click Save Settings.
* Everything is set!
* Now go to http://yourdomain.com/links/sync.php to download your links to your MySQL database.
* Go to http://yourdomain.com/links/
* You're all done!

## Requirements
* An account at https://delicious.com (it's free) with links
* A MySQL database
* A webserver (shared hosting is just fine): PHP 5.2 or higher with cURL support on your webserver

## Good to know
* If you want to keep your database up to date set up a cron job to wget http://yourdomain.com/links/sync.php or visit that page frequently.
* Every time you sync your links and the server is able to get your links from [delicious.com](https://delicious.com), the script empties the MySQL table and fills it with your current links on [delicious.com](https://delicious.com).
* Please wait at least one second between synchronisations, or you are likely to get automatically throttled by (https://delicious.com). 

## Demo
* Frontpage: https://michelstuyts.be/links/
* Page to sync links: https://michelstuyts.be/links/sync.php