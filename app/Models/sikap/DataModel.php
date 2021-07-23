<?php

namespace App\Models\sikap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataModel extends Model
{

    public static function getMainList()
    {
        $rows = DB::select("select * from main");
        return $rows;
    }

    public static function getSubMainTableList($main)
    {
        // Select record
        $rows = DB::select("select iku.id as id_iku, iku.main, iku.sub, iku.nama_iku, tabel.id as id_tabel, tabel.judul_tabel from iku
        INNER JOIN
        referensi_tabel AS RT
        ON iku.id = RT.id_iku
        INNER JOIN tabel
        ON RT.id_tabel = tabel.id
        where main='$main'
        group by id_iku");
        return $rows;
    }
}
