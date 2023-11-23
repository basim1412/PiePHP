<?php

namespace Core;

/**
 * @property string $table
 */

abstract class Entity
{
    protected $orm;
    protected $array;
    protected $relations = [];
    protected $table;


    public function __construct($array = array())
    {
        $this->array = $array;
        $this->orm = new ORM();
        foreach (array_keys($array) as $key) {
            $this->$key = $array[$key];
        }
    }

    public function save()
    {
        return $this->orm->create($this->table, $this->array);
    }

    public function findAll($where = [])
    {
        $whereSql = "";
        if ($where) {
            $whereSql = "WHERE ";
            $whereSql .= implode(" AND ", array_map(function ($key) use ($where) {
                return "$key = \"{$where[$key]}\"";
            }, array_keys($where)));
        }
        return $this->orm->find($this->table, array('WHERE' => $whereSql), $this->relations);
    }

    public function delete($id)
    {
        return $this->orm->delete($this->table, $id);
    }

    public function update($id, $fields)
    {
        return $this->orm->update($this->table, $id, $fields);
    }
}
