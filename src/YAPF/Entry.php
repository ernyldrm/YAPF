<?php
namespace YAPF;

use YAPF\Core\Controller;
use YAPF\Core\Router;

/**
 * Class Entry
 * @package YAPF
 */
class Entry
{
    /**
     * Construct new Entry
     */
    public function __construct()
    {
        $route = Router::find();
        if ($route !== null)
            Controller::run($route);
    }
}