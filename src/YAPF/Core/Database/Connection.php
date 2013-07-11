<?php
namespace YAPF\Core\Database;

use YAPF\Core\Config;

/**
 * Class Connection
 * @package YAPF\Core\Database
 */
abstract class Connection
{
    /**
     * Singleton database connection
     * @var
     */
    private static $singleton;

    /**
     * Get correct connection driver (Singleton)
     * @return Connection
     */
    public static function getInstance()
    {
        if (self::$singleton === null) {
            $config = Config::get('Database');
            $driver = 'YAPF\\Core\\Database\\Driver\\' . $config['driver'] . '\\Connection';

            self::$singleton = new $driver($config);
        }

        return self::$singleton;
    }
}