<?php

namespace App\Database;

class DatabaseConnector
{
    private static $qb;

    public static function GetQueryBuilder()
    {
        if (self::$qb === null) {
            new \Pixie\Connection('sqlite', [
                'driver' => 'sqlite',
                'database' => 'database.sqlite',
            ], 'QB');

            self::$qb = QB;

            // enable sqlite3 foreign keys
            self::$qb::query("PRAGMA foreign_keys = ON;");
        }

        return self::$qb;
    }
}