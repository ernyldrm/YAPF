<?php
namespace YAPF\Core;

/**
 * Class View
 * @package YAPF\Core
 */
class View
{
    /**
     * View path
     * @var string
     */
    private $path;

    /**
     * Arguments of view
     * @var array
     */
    private $arguments;

    /**
     * Construct new View
     * @param string $pattern View pattern
     * @param array $arguments Arguments of view
     */
    public function __construct($pattern, $arguments = array())
    {
        $this->path = YAPF_APP . DIRECTORY_SEPARATOR .
            'View' . DIRECTORY_SEPARATOR .
            str_replace(':', DIRECTORY_SEPARATOR, $pattern) . '.php';

        $this->arguments = $arguments;
    }

    /**
     * Render view
     */
    public function render()
    {
        extract($this->arguments);
        require $this->path;
    }

    /**
     * Render partial view
     *
     * @param string $pattern View pattern
     * @param array $arguments Arguments of view
     */
    public static function partial($pattern, $arguments = array())
    {
        $view = new View($pattern, $arguments);
        $view->render();
    }
}