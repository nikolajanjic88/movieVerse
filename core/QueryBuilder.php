<?php

namespace Core;

class QueryBuilder
{
    protected $modelClass;
    protected $table;
    protected $wheres = [];
    protected $joins = [];
    protected $orderBy = '';
    protected $limit = '';
    protected $params = [];
    protected $columns = '*';

    public function __construct($modelClass, $table)
    {
        $this->modelClass = $modelClass;
        $this->table = $table;
    }

    public function select(...$columns)
    {
        $this->columns = implode(', ', $columns);

        return $this;
    }

    // ---------------- JOIN ----------------
    public function join($table, $first, $operator, $second, $type = 'INNER')
    {
        $this->joins[] = strtoupper($type) . " JOIN $table ON $first $operator $second";
        return $this;
    }

    // ---------------- WHERE ----------------
    public function where($column, $operator, $value)
    {
        $param = ':' . str_replace('.', '_', $column) . count($this->params); 
        $this->wheres[] = "$column $operator $param";
        $this->params[$param] = $value;
        return $this;
    }

    // ---------------- ORDER / LIMIT ----------------
    public function orderBy($column, $direction = 'ASC')
    {
        $this->orderBy = "ORDER BY $column " . strtoupper($direction);
        return $this;
    }

    public function limit($number)
    {
        $this->limit = "LIMIT " . intval($number);
        return $this;
    }

    // ---------------- GET ----------------
    public function get()
    {
        $sql = "SELECT {$this->columns} FROM {$this->table}";

        if (!empty($this->joins)) {
            $sql .= ' ' . implode(' ', $this->joins);
        }

        if (!empty($this->wheres)) {
            $sql .= " WHERE " . implode(' AND ', $this->wheres);
        }

        if ($this->orderBy) {
            $sql .= " " . $this->orderBy;
        }

        if ($this->limit) {
            $sql .= " " . $this->limit;
        }

        $stmt = $this->modelClass::getConnection()->prepare($sql);
        $stmt->execute($this->params);
        return $stmt->fetchAll();
    }

    public function first()
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }
}
