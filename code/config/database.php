<?php

namespace code\config;
use PDO;
use PDOException;


class Database
{
    private static $conn = null;

    public static function Connect()
    {
    if (self::$conn === null) {
        try {
            self::$conn = new PDO("mysql:host=localhost;dbname=MaBagnole;charset=utf8mb4","root","");

            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
        }
        return self::$conn;
    }

}
