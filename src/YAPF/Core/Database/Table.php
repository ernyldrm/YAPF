<?php
namespace YAPF\Core\Database;

use YAPF\Core\Config;

/**
 * Class Table
 * @package YAPF\Core\Database
 */
abstract class Table
{
    /**
     * Create correct table driver
     * @param string $model Model name
     * @return Table
     */
    public static function create($model)
    {
        $config = Config::get('Database');
        $table = 'YAPF\\Core\\Database\\Driver\\' . $config['driver'] . '\\Table';

        return new $table($model);
    }
}