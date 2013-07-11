<?php
namespace YAPF\Core;

/**
 * Class Route
 * @package YAPF\Core
 */
class Route
{
    /**
     * Controller
     * @var string
     */
    public $controller;

    /**
     * Action
     * @var string
     */
    public $action;

    /**
     * Arguments of action
     * @var array
     */
    public $arguments;

    /**
     * Construct new Route
     * @param string $pattern Route pattern
     * @param array $arguments Arguments of action
     */
    public function __construct($pattern, $arguments = array())
    {
        $pattern = explode(':', $pattern);

        $this->controller = YAPF_APP . '\\Controller\\' . str_replace('@', '\\', $pattern[0]);
        $this->action = $pattern[1];
        $this->arguments = $arguments;
    }
}