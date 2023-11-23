<?php

namespace Core;

use PDO;

class ORM
{
    protected $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getDatabase();
    }

    public function delete($table, $id)
    {
        $query = "DELETE FROM {$table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function create($table, $fields)
    {
        $columns = implode(',', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = $this->db->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})");
        $query->execute($fields);

        return $this->db->lastInsertId();
    }

    public function read($table, $id)
    {
        $query = $this->db->prepare("SELECT * FROM {$table} WHERE id = :id");
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update($table, $id, $fields)
    {
        $setColumns = '';
        foreach ($fields as $column => $value) {
            $setColumns .= "{$column} = :{$column},";
        }
        $setColumns = rtrim($setColumns, ',');

        $query = $this->db->prepare("UPDATE {$table} SET {$setColumns} WHERE id = :id");
        $fields['id'] = $id;
        $result = $query->execute($fields);
        var_dump($result);
        return $result;
    }

    // public function find($table, $conditions = [], $params = array(
    //     'ORDER BY' => 'id ASC',
    //     'LIMIT' => ''
    // ), $relations = null)
    // {
    //     $where = '1';
    //     if (!empty($conditions)) {
    //         $where = implode(' AND ', array_map(function ($key, $value) {
    //             return "{$key} = :{$value}";
    //         }, array_keys($conditions), array_keys($conditions)));
    //     }

    //     $orderBy = isset($params['ORDER BY']) ? 'ORDER BY ' . $params['ORDER BY'] : '';
    //     $limit = isset($params['LIMIT']) && !empty($params['LIMIT']) ? 'LIMIT ' . $params['LIMIT'] : '';

    //     $join = '';
    //     if ($relations) {
    //         foreach ($relations as $relationType => $relatedTable) {
    //             echo "Il y a une relation de type $relationType vers la table $relatedTable <br>";
    //             if ($relationType == 'manyToOne') {
    //                 $join .= "LEFT JOIN {$relatedTable} ON {$relatedTable}.id = {$relatedTable}.{$table}_id ";
    //             } else if ($relationType == 'oneToMany') {
    //                 $join .= "LEFT JOIN {$relatedTable} ON {$table}.id = {$relatedTable}.{$table}_id ";
    //             } else if ($relationType == 'manyToMany') {
    //                 $joinTable = $table . '_' . $relatedTable;
    //                 $join .= "LEFT JOIN {$joinTable} ON {$joinTable}.{$table}_id = {$table}.id ";
    //                 $join .= "LEFT JOIN {$relatedTable} ON {$joinTable}.{$relatedTable}_id = {$relatedTable}.id ";
    //             }
    //         }
    //     }

    //     $sql = "SELECT DISTINCT * FROM {$table} {$join} WHERE {$where} {$orderBy} {$limit}";
    //     $query = $this->db->prepare($sql);

    //     foreach ($conditions as $key => $value) {
    //         $query->bindValue(":{$key}", $value);
    //     }
    //     $query->execute();
    //     return $query->fetchAll(PDO::FETCH_ASSOC);
    // }

    private function findById($array, $id)
    {
        $i = 0;
        foreach ($array as $element) {
            if ($element['id'] == $id) {
                return $i;
            }
            $i++;
        }
        return -1;
    }

    public function find($table, $params = [], $relations = [])
    {
        $where = isset($params['WHERE']) ? $params['WHERE'] : '';
        $orderBy = isset($params['ORDER BY']) ? "ORDER BY " . $params['ORDER BY'] : '';
        $limit = isset($params['LIMIT']) ? "LIMIT " . $params['LIMIT'] : '';

        $query = $this->db->prepare("SELECT * FROM {$table} {$where} {$orderBy} {$limit}");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($relations as $relationType => $table2) {

            if ($relationType == 'manyToOne') {
                $query = $this->db->prepare("SELECT * FROM {$table2}");
                $query->execute();
                $resultRelation = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultRelation as $item) {
                    $table1Id = $item["id_{$table}"];
                    $indexToInsert = $this->findById($result, $table1Id);

                    if ($indexToInsert >= 0) {
                        $result[$indexToInsert][$table2][] = $item;
                    }
                }
            } else if ($relationType == 'oneToMany') {
                $query = $this->db->prepare("SELECT * FROM {$table2}");
                $query->execute();
                $resultRelation = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as &$item) {
                    $table2Id = $item["id_{$table2}"];
                    $table2Index = $this->findById($resultRelation, $table2Id);

                    if ($table2Index >= 0) {
                        $item[$table2] = $resultRelation[$table2Index];
                    }
                }
            } else if ($relationType == 'manyToMany') {
                $table_join = ($table > $table2) ? "{$table}_{$table2}" : "{$table2}_{$table}";
                $query = $this->db->prepare("SELECT id_{$table}, $table2.* FROM {$table_join} LEFT JOIN $table2 ON {$table_join}.id_{$table2} = $table2.id");
                $query->execute();
                $resultJoin = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultJoin as $item) {
                    $table1Id = $item["id_{$table}"];
                    $indexToInsert = $this->findById($result, $table1Id);

                    if ($indexToInsert >= 0) {
                        unset($item["id_{$table}"]);
                        $result[$indexToInsert][$table2][] = $item;
                    }
                }
            }
        }
        return $result;
    }
}
