<?php
namespace YAPF\Core;

class Config
{
    private static $config;

    private static function load($section)
    {
        self::$config = require YAPF_APP . DIRECTORY_SEPARATOR .
            'Config' . DIRECTORY_SEPARATOR .
            $section . '.php';
    }

    public static function get($section)
    {
        if (self::$config[$section] === null)
            self::load($section);

        return self::$config[$section];
    }
}