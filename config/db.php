<?php

class Database
{
    private static $connection = null;

    private function __construct() {
    }

    public static function establishConnection() {
        if(is_null(self::$connection)) {
            self::$connection = new PDO("mysql:host=localhost;dbname=hwi_dev", 'root', 'root');
        }
        return self::$connection;
    }
}
?>