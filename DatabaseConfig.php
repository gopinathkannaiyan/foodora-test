<?php
/**
 * Class for DatabaseConfig
 * @author gkannaiy
 *
 */
class DatabaseConfig
{
    
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'gopi';
    private static $dbName = 'foodora-test' ;
    
    private static $cont  = null;
    
    /**
     * Constrcut method
     */
    public function __construct()
    {
        exit('Init function is not allowed');
    }
    
    /**
     * PDO database connection starts
     * return database connection instance
     */
    public function connect()
    {
        // One connection through whole application
        if (null == self::$cont) {
            try {
                self::$cont =  new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }
    
    /**
     * PDO database connection close
     */
    public static function disconnect()
    {
        $this->cont = null;
    }
}
