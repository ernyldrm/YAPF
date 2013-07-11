<?php
namespace YAPF\Core;

/**
 * Class Router
 * @package YAPF\Core
 */
class Router
{
    /**
     * Wildcards for pattern
     * @var array
     */
    private static $wildcards = array(
        ':any' => '(\w+)',
        ':num' => '(\d+)'
    );

    /**
     * Get requested route
     * @return string
     */
    private static function getRequest()
    {
        return trim(str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['PHP_SELF']), '/');
    }

    /**
     * Find correct route from all routes
     * @return Route|null Route if found, otherwise null
     */
    public static function find()
    {
        $routes = Config::get('Routes');
        $request = self::getRequest();

        if ($request === '')
            return new Route($routes['']);

        unset($routes['']);
        foreach ($routes as $pattern => $route) {
            $regex = '#^' . strtr($pattern, self::$wildcards) . '#';
            if (preg_match($regex, $request) === 1) {
                $arguments = explode('/', preg_replace($regex, $route, $request));
                return new Route(array_shift($arguments), $arguments);
            }
        }

        return null;
    }
}