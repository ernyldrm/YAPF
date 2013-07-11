<?php
namespace YAPF\Core;

/**
 * Class Config
 * @package YAPF\Core
 */
class Config
{
    /**
     * Config values
     * @var array
     */
    private static $config;

    /**
     * Load config file into self::$config[$section]
     * @param string $section Section name
     */
    private static function load($section)
    {
        self::$config[$section] = require YAPF_APP . DIRECTORY_SEPARATOR .
            'Config' . DIRECTORY_SEPARATOR .
            $section . '.php';
    }

    /**
     * Get config section
     * @param string $section Section name
     * @return mixed|null mixed if section isset, otherwise null
     */
    public static function get($section)
    {
        if (isset(self::$config[$section]) === false)
            self::load($section);

        return self::$config[$section];
    }

    /**
     * Set config section
     * @param string $section Section name
     * @param mixed $value Value
     */
    public static function set($section, $value)
    {
        self::$config[$section] = $value;
    }
}