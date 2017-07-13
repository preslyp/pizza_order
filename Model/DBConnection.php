<?php
/**
 * Created by PhpStorm.
 * User: pancho
 * Date: 7/5/17
 * Time: 3:19 PM
 */

namespace Pizza\Model;

define('DB_HOST', 'localhost');
define('DB_NAME', 'db_pizza');
define('DB_USER', 'root');
define('DB_PASS', '111111');

class DBConnection
{
    private static $db = null;
    public static function getDb() {
        if (self::$db === null) {
            try {
                self::$db = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
                self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                throw new \PDOException("Failed to connect to database!");
            }
        }
        return self::$db;
    }

}