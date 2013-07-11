<?php
namespace YAPF\Core;

use YAPF\Core\Database\Table;

/**
 * Class Database
 * @package YAPF\Core
 */
class Database
{
    /**
     * Call model's table
     *
     * @param string $name Name of model
     * @param array $arguments Arguments (EMPTY)
     * @return Table
     */
    public static function __callStatic($name, $arguments)
    {
        return Table::create(YAPF_APP . '\\Model\\' . $name);
    }
}