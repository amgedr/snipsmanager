Thank you for purchasing SnipsManager. If you have any questions please visit http://codehill.com/my-account/ to read the knowledgebase articles and submit support tickets.


Installation Instructions
=========================
To install SnipsManager follow these steps:

1. Decompress the file you downloaded in a folder in your computer.
2. Log in to you web hosting account using an FTP client like Filezilla and upload the contents of the folder.
3. Log in to your web hosting account’s control panel and create a MySQL database.
4. Run the installer by calling the install.php page in the root folder, and enter the details of the database you created.
5. Delete the install.php and upgrade.php files in the root folder using your FTP client.


Upgrade Instructions
====================
To upgrade from CodeHave version 1.2 to SnipsManager version 2.0 or above follow these steps:

1. Backup the database and files.
2. Delete all the files except config.php, this file contains your database settings.
3. Upload all the files except config.php of course.
4. Open the upgrade.php page in your browser and click the Start Database Upgrade button.
5. Delete the upgrade.php and install.php files.

