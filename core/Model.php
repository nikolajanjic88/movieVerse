<?php

namespace Core;

use PDO;

abstract class Model
{
    protected static $table;
    protected static $primaryKey = 'id';
    protected static $connection;

    protected $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    // Database Connection
    public static function getConnection()
    {
        if (!self::$connection) {
            $dsn = "mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            self::$connection = new PDO($dsn, USERNAME, PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }

        return self::$connection;
    }

    public static function query()
    {
        return new QueryBuilder(static::class, static::$table);
    }

    public static function where($column, $operator, $value)
    {
        return static::query()->where($column, $operator, $value);
    }


    public static function all()
    {
        $stmt = self::getConnection()->prepare("SELECT * FROM " . static::$table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function find($id)
    {
        $stmt = self::getConnection()->prepare(
            "SELECT * FROM " . static::$table . " WHERE " . static::$primaryKey . " = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function findOrFail($id) 
    {
        $result = self::find($id);

        if(!$result) {
            abort();
        }    
        return $result;        
    }

    public function save()
    {
        $columns = array_keys($this->attributes);

        if (isset($this->attributes[static::$primaryKey])) 
        {
            // Update
            $set = implode(', ', array_map(fn($col) => "$col = :$col", $columns));
            $sql = "UPDATE " . static::$table . " SET $set WHERE " . static::$primaryKey . " = :" . static::$primaryKey;
        } else 
        {
            // Insert
            $cols = implode(', ', $columns);
            $placeholders = implode(', ', array_map(fn($col) => ":$col", $columns));
            $sql = "INSERT INTO " . static::$table . " ($cols) VALUES ($placeholders)";
        }

        $stmt = self::getConnection()->prepare($sql);
        return $stmt->execute($this->attributes);
    }

    public function delete()
    {
        $stmt = self::getConnection()->prepare(
            "DELETE FROM " . static::$table . " WHERE " . static::$primaryKey . " = :id"
        );
        return $stmt->execute(['id' => $this->attributes[static::$primaryKey]]);
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }
}
