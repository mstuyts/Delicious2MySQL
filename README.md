# Delicious2MySQL
__*A PHP script to backup all your [delicious.com](https://delicious.com) links to a MySQL database*__.

## Installation
* Copy all files from this repository to your webserver. We assume you upload them to a folder named 'links' in your root folder. This way you'll end up with Delicious2MySQL in http://yourdomain.com/links/. 
* In your browser you go to the url http://yourdomain.com/links/.
* Fill in the necessary settings and click Save Settings.
* Everything is set!
* Now go to http://yourdomain.com/links/sync.php to download your links to your MySQL database.
* Go to http://yourdomain.com/links/
* You're all done!


> If you want to keep your database up to date set up a cron job to wget http://yourdomain.com/links/sync.php or visit that page frequently.

## Requirements
* An account at https://delicious.com (it's free)
* A webserver with PHP (shared hosting is just fine)
* A MySQL database

## Demo
* Frontpage: https://michelstuyts.be/links/
* Page to sync links: https://michelstuyts.be/links/sync.php