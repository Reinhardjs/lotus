<?php

namespace App\Models\sikap\v3;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageModel extends Model
{

    public static function getDataGrafikV3()
    {
        $rows = DB::select("SELECT v3.*, iku.* FROM iku
        LEFT JOIN data_v3 v3 ON iku.sub = v3.sub
        WHERE iku.main='nko2021'");

        $data_grafik = array();

        foreach ($rows as $row) {
            $row = (array) $row;
            $columns = ["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober", "november", "desember"];
            $values = array(
                "sub" => $row["sub"],
                "nko2018" => array(),
                "nko2019" => array(),
                "nko2020" => array(),
                "nko2021" => array()
            );

            foreach ($columns as $column) {
                $q1 = explode("#", $row[$column])[0] ?? "";
                $q2 = explode("#", $row[$column])[1] ?? "";
                $q3 = explode("#", $row[$column])[2] ?? "";
                $q4 = explode("#", $row[$column])[3] ?? "";

                array_push($values["nko2018"], $q1);
                array_push($values["nko2019"], $q2);
                array_push($values["nko2020"], $q3);
                array_push($values["nko2021"], $q4);
            }
            array_push($data_grafik, $values);
        }

        return $data_grafik;
    }
}
