<?php

namespace App\Base;

use App\Database\DatabaseConnector;
use Exception;

class BaseModel
{
    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            // security measure to prevent passing invalid parameters
            if (!property_exists($this, $key)) {
                throw new Exception("Invalid property: " . $key);
            }

            $this->$key = $value;
        }
    }

    public function Save()
    {
        $child = get_called_class();
        $table = $child::$db_table;

        $vars = get_object_vars($this);
        unset($vars["id"]);

        // run through validation, at the expense of another
        // object being created but no duplicate code is required
        // will throw an exception which will hopefully be caught
        new $child($vars);

        $QB = DatabaseConnector::GetQueryBuilder();
        $QB::table($table)->where('id', $this->id)->update($vars);
    }

    public function Destroy()
    {
        $child = get_called_class();
        $table = $child::$db_table;

        $QB = DatabaseConnector::GetQueryBuilder();
        $QB::table($table)->where('id', $this->id)->delete();
    }

    // HELPER FUNCTIONS
    private static function ProcessFindQuery($table, $query)
    {
        $SUPPORTED_NESTED_QUERIES = [
            '$in',
        ];

        $QB = DatabaseConnector::GetQueryBuilder();
        $q = $QB::table($table);

        foreach ($query as $key => $clause) {
            if (in_array($clause[1], $SUPPORTED_NESTED_QUERIES)) {
                switch ($key) {
                    case '$in':
                        $q->whereIn($clause[0], $clause[2]);
                        break;

                    default:
                        break;
                }
            } else {
                $q->where($clause[0], $clause[1], $clause[2]);
            }
        }

        return $q;
    }

    // GENERIC STATIC QUERIES

    public static function All()
    {
        $child = get_called_class();
        $table = $child::$db_table;

        $QB = DatabaseConnector::GetQueryBuilder();

        $result = $QB::table($table)->select('*')->get();
        $all = [];

        foreach ($result as $row) {
            $x = new $child($row);

            array_push($all, $x);
        }

        return $all;
    }

    public static function Find($query = [])
    {
        $child = get_called_class();
        $table = $child::$db_table;

        $q = static::ProcessFindQuery($table, $query);

        $rows = $q->get();
        $items = [];

        foreach ($rows as $row) {
            $x = new $child($row);

            array_push($items, $x);
        }

        return $items;
    }

    public static function FindOne($query = [])
    {
        $child = get_called_class();
        $table = $child::$db_table;

        $q = static::ProcessFindQuery($table, $query);

        $row = $q->first();

        if ($row == null) {
            return null;
        }

        return new $child($row);
    }

    public static function Insert($values)
    {
        $child = get_called_class();
        $table = $child::$db_table;

        $QB = DatabaseConnector::GetQueryBuilder();
        $new_object = new $child($values);

        $id = $QB::table($table)->insert($values);

        $new_object->id = $id;

        return $new_object;
    }

    public static function Delete($query = [])
    {
        $child = get_called_class();
        $table = $child::$db_table;

        $q = static::ProcessFindQuery($table, $query);

        $q->delete();
    }
}