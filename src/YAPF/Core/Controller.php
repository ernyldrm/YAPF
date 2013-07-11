<?php
namespace YAPF\Core;

/**
 * Class Controller
 * @package YAPF\Core
 */
class Controller
{
    /**
     * Run controller
     * @param Route $route Route
     */
    public static function run(Route $route)
    {
        if (class_exists($route->controller) === false)
            die("Controller {$route->controller} not found!");

        $controller = new $route->controller;
        $action = array($controller, $route->action);

        if (is_callable($action) === false)
            die("Action {$route->action} not found!");

        self::processResult(call_user_func_array($action, $route->arguments));
    }

    /**
     * Process result of action
     * @param mixed $result Result of action
     */
    public static function processResult($result)
    {
        if ($result instanceof Route)
            self::run($result);
        else if ($result instanceof View)
            $result->render();
    }
}