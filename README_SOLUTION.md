# foodora-test-solution

# Folder Structure
foodora-test
  README.md
  DatabaseConfig.php
  backup-and-update-special-days.php
  restore-regular-days.php
  
  Database related configuration in DatabaseConfig.php
    [source,php]
  	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = 'gopi';
	private static $dbName = 'foodora-test' ;
	
  Take backup and update special days - backup-and-update-special-days.php
    [source,php]
  	$bkupdatespldays = new BackupUpdateSplDays(); // Class 
	$bkupdatespldays->updatespldays(); // $this->backup(); regular days backup and update special days
	$bkupdatespldays->removeduplicate(); // Remove duplicate
  
  Restore regular days - restore-regular-days.php
    [source,php]
  	$restoreregdays = new RestoreRegularDays(); // Class
	$restoreregdays->restore(); // Restore regular days and remove the temp table.
  
  Cron OR Shell
     [source,php]
     2015-12-20 23:00:00
     /usr/bin/php /var/www/html/foodora/backup-and-update-special-days.php
     2015-12-28 01:00:00
     /usr/bin/php /var/www/html/foodora/restore-regular-days.php
  
  
  
  

  '
