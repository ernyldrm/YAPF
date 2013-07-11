<?php
namespace YAPF\Core\Database\Driver\Mysql;

use YAPF\Core\Database;
use YAPF\Core\Database\Connection;

class Table
{
    private $model;

    private $table;
    private $pk;

    private $select = '*';
    private $where = null;
    private $group = null;
    private $having = null;
    private $order = null;
    private $limit = null;
    private $offset = null;

    private $params = array();

    public function __construct($model)
    {
        $this->model = $model;
        $this->table = '`' . $model::$table . '`';
        $this->pk = '`' . $model::$pk . '`';
    }

    /** SELECT */
    public function select()
    {
        $columns = func_get_args();
        array_walk($columns, function (&$value, $key) {
            $value = '`' . $value . '`';
        });

        $this->select = implode(', ', $columns);

        return $this;
    }

    /** WHERE */
    public function where()
    {
        $arguments = func_get_args();

        $this->where = array_shift($arguments);
        $this->params = array_merge($this->params, $arguments);

        return $this;
    }

    public function group($group)
    {
        $this->group = $group;

        return $this;
    }

    public function having()
    {
        $arguments = func_get_args();

        $this->having = array_shift($arguments);
        $this->params = array_merge($this->params, $arguments);

        return $this;
    }

    public function order($order)
    {
        $this->order = $order;

        return $this;
    }

    public function limit($limit, $offset = 0)
    {
        $this->limit = $limit;
        $this->offset = $offset;

        return $this;
    }

    private function execute($sql, $return = 'all')
    {
        $stmt = Connection::getInstance()->prepare($sql);
        $status = $stmt->execute($this->params);
        $this->params = array();

        $results = $stmt->fetchAll(\PDO::FETCH_CLASS, $this->model);
        if ($return === 'all')
            return $results;
        else if ($return === 'first')
            return $results[0];
        else if ($return === 'status')
            return $status;
    }

    /** CRUD */
    public function get($mode = 'all')
    {
        $sql = 'SELECT ' . $this->select . ' FROM ' . $this->table;
        if ($this->where !== null)
            $sql .= ' WHERE ' . $this->where;
        if ($this->group !== null)
            $sql .= ' GROUP BY ' . $this->group;
        if ($this->having !== null)
            $sql .= ' HAVING ' . $this->having;
        if ($this->order !== null)
            $sql .= ' ORDER BY ' . $this->order;
        if ($this->limit !== null)
            $sql .= ' LIMIT ' . $this->limit . ' OFFSET ' . $this->offset;

        echo $sql;

        return $this->execute($sql, $mode);
    }

    public function find($id)
    {
        $sql = 'SELECT ' . $this->select . ' FROM ' . $this->table . ' WHERE ' . $this->pk . ' = ?';
        $this->params = (array)$id;

        return $this->execute($sql, 'first');
    }


    public function update($model)
    {
        $keys = $model->getColumns();
        array_walk($keys, function (&$value, $key) {
            $value = '`' . $value . '` = ?';
        });

        $sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $keys) . ' WHERE ' . $this->pk . ' = ?';
        $this->params = array_merge($model->getValues(), (array)$model->getPkValue());

        return $this->execute($sql, 'status');
    }

    public function delete($model)
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $this->pk . ' = ?';
        $this->params = (array)$model->getPkValue();

        return $this->execute($sql, 'status');
    }

    public function add($model)
    {
        $keys = $model->getColumns();
        array_walk($keys, function (&$value, $key) {
            $value = '`' . $value . '`';
        });

        $sql = 'INSERT INTO ' . $this->table . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', array_fill(0, count($model->getValues()), '?')) . ')';
        $this->params = $model->getValues();

        return $this->execute($sql, 'status');
    }
}