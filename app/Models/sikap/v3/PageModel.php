<?php

namespace App\Models\sikap\v3;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageModel extends Model
{

    public static function getMain($main)
    {
        // Select record
        $row = DB::table('nko')->where('main', $main)->first();
        return $row;
    }

    public static function getMains()
    {
    }

    public static function getSub($main, $sub)
    {
        // Select record
        $row = DB::table('iku')->where(['main' => $main, 'sub' => $sub])->first();

        return $row;
    }

    public static function getSubs($main)
    {
        $rows = DB::select("SELECT iku.*, rt.*, t.*, m.main FROM iku
        INNER JOIN main m ON iku.main = m.main
        INNER JOIN (
        SELECT id_iku, main_iku, id_tabel FROM referensi_tabel GROUP BY id_iku
        ) rt ON iku.id = rt.id_iku
        INNER JOIN tabel t ON rt.id_tabel = t.id
        WHERE iku.main='$main'");
        return $rows;
    }

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

    public static function getTabel($main, $sub)
    {

        $row = DB::table('data_v3')->where(['main' => $main, 'sub' => $sub])->first();

        if ($row == null) {
            return null;
        }

        $explode_januari = explode("#", $row->januari);
        $explode_februari = explode("#", $row->februari);
        $explode_maret = explode("#", $row->maret);
        $explode_april = explode("#", $row->april);
        $explode_mei = explode("#", $row->mei);
        $explode_juni = explode("#", $row->juni);
        $explode_juli = explode("#", $row->juli);
        $explode_agustus = explode("#", $row->agustus);
        $explode_september = explode("#", $row->september);
        $explode_oktober = explode("#", $row->oktober);
        $explode_november = explode("#", $row->november);
        $explode_desember = explode("#", $row->desember);

        $data_tabel = array(
            "januari" => array(
                "Q1" => $explode_januari[0],
                "Q2" => $explode_januari[1],
                "Q3" => $explode_januari[2],
                "Q4" => $explode_januari[3]
            ),
            "februari" => array(
                "Q1" => $explode_februari[0],
                "Q2" => $explode_februari[1],
                "Q3" => $explode_februari[2],
                "Q4" => $explode_februari[3]
            ),
            "maret" => array(
                "Q1" => $explode_maret[0],
                "Q2" => $explode_maret[1],
                "Q3" => $explode_maret[2],
                "Q4" => $explode_maret[3]
            ),
            "april" => array(
                "Q1" => $explode_april[0],
                "Q2" => $explode_april[1],
                "Q3" => $explode_april[2],
                "Q4" => $explode_april[3]
            ),
            "mei" => array(
                "Q1" => $explode_mei[0],
                "Q2" => $explode_mei[1],
                "Q3" => $explode_mei[2],
                "Q4" => $explode_mei[3]
            ),
            "juni" => array(
                "Q1" => $explode_juni[0],
                "Q2" => $explode_juni[1],
                "Q3" => $explode_juni[2],
                "Q4" => $explode_juni[3]
            ),
            "juli" => array(
                "Q1" => $explode_juli[0],
                "Q2" => $explode_juli[1],
                "Q3" => $explode_juli[2],
                "Q4" => $explode_juli[3]
            ),
            "agustus" => array(
                "Q1" => $explode_agustus[0],
                "Q2" => $explode_agustus[1],
                "Q3" => $explode_agustus[2],
                "Q4" => $explode_agustus[3]
            ),
            "september" => array(
                "Q1" => $explode_september[0],
                "Q2" => $explode_september[1],
                "Q3" => $explode_september[2],
                "Q4" => $explode_september[3]
            ),
            "oktober" => array(
                "Q1" => $explode_oktober[0],
                "Q2" => $explode_oktober[1],
                "Q3" => $explode_oktober[2],
                "Q4" => $explode_oktober[3]
            ),
            "november" => array(
                "Q1" => $explode_november[0],
                "Q2" => $explode_november[1],
                "Q3" => $explode_november[2],
                "Q4" => $explode_november[3]
            ),
            "desember" => array(
                "Q1" => $explode_desember[0],
                "Q2" => $explode_desember[1],
                "Q3" => $explode_desember[2],
                "Q4" => $explode_desember[3]
            ),
        );

        return $data_tabel;
    }
}
