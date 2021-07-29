<?php

namespace App\Models\basic;

use Illuminate\Support\Facades\DB;

class CrudModel
{
    public static function getAll($table_name)
    {
        $rows = DB::select("select * from $table_name");
        return $rows;
    }

    public static function getAllWhere($table_name, $where)
    {
        $rows = DB::table($table_name)->where($where);
        return $rows;
    }

    public static function getRow($table_name, $where)
    {
        $row = DB::table($table_name)->where($where)->first();
        return $row;
    }

    public static function add($table_name, $data)
    {
        $inserted_id = DB::table($table_name)->insertGetId($data);
        return $inserted_id;
    }

    public static function update($table_name, $data, $where)
    {
        return DB::table($table_name)->where($where)->update($data);
    }

    public static function delete($table_name, $where)
    {
        return DB::table($table_name)->where($where)->delete();
    }
}
