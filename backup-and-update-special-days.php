<?php 
require 'DatabaseConfig.php';
/**
 * 
 * @author gkannaiy
 *
 */
class BackupUpdateSplDays
{
    public function __construct()
    {
        $this->pdo = DatabaseConfig::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    /**
     * Backup regular days before updating special days
     */
    public function backup()
    {
        $sql = "DROP TABLE IF EXISTS `temp`; CREATE TABLE IF NOT EXISTS temp AS (SELECT * FROM vendor_schedule)";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
    }
    
    /**
     * Update special days
     */
    public function updatespldays()
    {
        $this->backup();
        $sql = "SELECT t1.id, t2.all_day, t2.start_hour, t2.stop_hour 
				FROM vendor_schedule as t1, vendor_special_day t2 
				WHERE t1.vendor_id = t2.vendor_id AND t1.weekday = (WEEKDAY(t2.special_date) + 1) GROUP BY (WEEKDAY(t2.special_date) + 1)";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            foreach ($result as $row) {
                $id = $row['id'];
                $all_day = $row['all_day'];
                $start_hour = $row['start_hour'];
                $stop_hour = $row['stop_hour'];
                $update_sql = "UPDATE vendor_schedule SET all_day='$all_day', start_hour='$start_hour', stop_hour='$stop_hour' WHERE id='$id'";
                $sth = $this->pdo->prepare($update_sql);
                $sth->execute();
            }
        }
    }
    
    /**
     * Removing redundant data
     */
    public function removeduplicate()
    {
        $sql = "SELECT t1.id FROM vendor_schedule as t1, vendor_schedule t2 WHERE t1.id > t2.id AND t1.weekday = t2.weekday AND t1.all_day = t2.all_day";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            foreach ($result as $row) {
                $id = $row['id'];
                $delsql = "DELETE FROM vendor_schedule WHERE id='$id'";
                $sth = $this->pdo->prepare($delsql);
                $sth->execute();
            }
        }
    }
}
$bkupdatespldays = new BackupUpdateSplDays();
$bkupdatespldays->updatespldays();
$bkupdatespldays->removeduplicate();
