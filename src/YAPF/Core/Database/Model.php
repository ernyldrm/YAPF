<?php
namespace YAPF\Core\Database;

/**
 * Class Model
 * @package YAPF\Core\Database
 */
class Model
{
    /**
     * Primary key
     * @var string
     */
    public static $pk = 'id';

    /**
     * Columns
     * @var array
     */
    private $column;

    /**
     * Construct a Model
     * @param array $defaults Values (Key => Value)
     */
    public function __construct($defaults = array())
    {
        foreach ($defaults as $key => $value)
            $this->$key = $value;
    }

    /**
     * Get column
     * @param string $name Column name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->column[$name];
    }

    /**
     * Set column
     * @param string $name Column name
     * @param mixed $value Column value
     */
    public function __set($name, $value)
    {
        $this->column[$name] = $value;
    }

    /**
     * Get all column names
     * @return array
     */
    public function getColumns()
    {
        return array_keys($this->column);
    }

    /**
     * Get all column values
     * @return array
     */
    public function getValues()
    {
        return array_values($this->column);
    }

    /**
     * Get primary key value
     * @return mixed
     */
    public function getPkValue()
    {
        return $this->{self::$pk};
    }
}