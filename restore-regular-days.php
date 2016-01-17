<?php 
require 'DatabaseConfig.php';
/*
 * Class for remove regular days backup and restore special days data into regular days 
 */
class RestoreRegularDays
{
    public function __construct()
    {
        $this->pdo = DatabaseConfig::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /**
     * Remove regular days backup data and restore regular days data
     */
    public function restore()
    {
        $sql = "TRUNCATE vendor_schedule; INSERT INTO vendor_schedule SELECT * FROM temp; DROP TABLE IF EXISTS `temp`;";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
    }
}
$restoreregdays = new RestoreRegularDays();
$restoreregdays->restore();
