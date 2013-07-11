<?php
namespace YAPF\Core\Database\Driver\Mysql;

/**
 * Class Connection
 * @package YAPF\Core\Database\Driver\Mysql
 */
class Connection extends \PDO
{
    /**
     * Create mysql-pdo
     * @param array $config Connection config
     */
    public function __construct($config)
    {
        $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s', $config['host'], $config['port'], $config['database']);
        parent::__construct($dsn, $config['username'], $config['password'], array(
            self::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $config['charset']
        ));
    }
}