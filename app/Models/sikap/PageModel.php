<?php

namespace App\Models\sikap;

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

    public static function getDataGrafikV2()
    {
        $data_grafik = array();
        array_push($data_grafik, array(
            "kategori" => "capaian",
            "data" => array(
                "nko2018" => array(),
                "nko2019" => array(),
                "nko2020" => array(),
                "nko2021" => array()
            )
        ));
        array_push($data_grafik, array(
            "kategori" => "realisasi",
            "data" => array(
                "nko2018" => array(),
                "nko2019" => array(),
                "nko2020" => array(),
                "nko2021" => array()
            )
        ));

        $results = DB::select("SELECT * FROM iku
        INNER JOIN (
        SELECT id_iku, main_iku, id_tabel FROM referensi_tabel GROUP BY id_iku
        ) rt ON iku.id = rt.id_iku
        INNER JOIN tabel t ON rt.id_tabel = t.id 
        WHERE iku.main='nko2021'");

        foreach ($results as $row) {
            $explode_capaian = explode("#", $row->capaian);
            $explode_realisasi = explode("#", $row->realisasi);
            array_push($data_grafik[0]["data"]["nko2021"], $explode_capaian[3]); // capaian [3] -> Q4
            array_push($data_grafik[1]["data"]["nko2021"], $explode_realisasi[3]); // realisasi [3] -> Q4


            $row2018 = DB::select("SELECT RT.id_iku, RT.main_iku, RT.id_tabel, t.* FROM referensi_tabel as RT
            INNER JOIN tabel t ON RT.id_tabel = t.id 
            WHERE RT.id_iku='{$row->id_iku}' and RT.main_iku='nko2018'")[0];

            if ($row2018 != null) {
                $explode_capaian = explode("#", $row2018->capaian);
                $explode_realisasi = explode("#", $row2018->realisasi);
                array_push($data_grafik[0]["data"]["nko2018"], str_replace(",", ".", $explode_capaian[3])); // capaian [3] -> Q4
                array_push($data_grafik[1]["data"]["nko2018"], str_replace(",", ".", $explode_realisasi[3])); // realisasi [3] -> Q4
            } else {
                array_push($data_grafik[0]["data"]["nko2018"], "0.0"); // capaian [3] -> Q4
                array_push($data_grafik[1]["data"]["nko2018"], "0.0"); // realisasi [3] -> Q4
            }

            $row2019 = DB::select("SELECT RT.id_iku, RT.main_iku, RT.id_tabel, t.* FROM referensi_tabel as RT
            INNER JOIN tabel t ON RT.id_tabel = t.id 
            WHERE RT.id_iku='{$row->id_iku}' and RT.main_iku='nko2019'")[0];

            if ($row2019 != null) {
                $explode_capaian = explode("#", $row2019->capaian);
                $explode_realisasi = explode("#", $row2019->realisasi);
                array_push($data_grafik[0]["data"]["nko2019"], str_replace(",", ".", $explode_capaian[3])); // capaian [3] -> Q4
                array_push($data_grafik[1]["data"]["nko2019"], str_replace(",", ".", $explode_realisasi[3])); // realisasi [3] -> Q4
            } else {
                array_push($data_grafik[0]["data"]["nko2019"], "0.0"); // capaian [3] -> Q4
                array_push($data_grafik[1]["data"]["nko2019"], "0.0"); // realisasi [3] -> Q4
            }

            $row2020 = DB::select("SELECT RT.id_iku, RT.main_iku, RT.id_tabel, t.* FROM referensi_tabel as RT
            INNER JOIN tabel t ON RT.id_tabel = t.id 
            WHERE RT.id_iku='{$row->id_iku}' and RT.main_iku='nko2020'")[0];

            if ($row2020 != null) {
                $explode_capaian = explode("#", $row2020->capaian);
                $explode_realisasi = explode("#", $row2020->realisasi);
                array_push($data_grafik[0]["data"]["nko2020"], str_replace(",", ".", $explode_capaian[3])); // capaian [3] -> Q4
                array_push($data_grafik[1]["data"]["nko2020"], str_replace(",", ".", $explode_realisasi[3])); // realisasi [3] -> Q4
            } else {
                array_push($data_grafik[0]["data"]["nko2020"], "0.0"); // capaian [3] -> Q4
                array_push($data_grafik[1]["data"]["nko2020"], "0.0"); // realisasi [3] -> Q4
            }
        }

        return $data_grafik;
    }

    public static function getTabel($main, $sub)
    {
        $row = DB::table('iku')->where(['main' => $main, 'sub' => $sub])->first();

        $row = DB::table('referensi_tabel')->where('id_iku', $row->id)->first();

        $row = DB::table('tabel')->where('id', $row->id_tabel)->first();

        $explode_target = explode("#", $row->target);
        $explode_realisasi = explode("#", $row->realisasi);
        $explode_capaian = explode("#", $row->capaian);

        $data_tabel = array(
            "judul_tabel" => $row->judul_tabel,
            "target" => array(
                "Q1" => $explode_target[0],
                "Q2" => $explode_target[1],
                "Q3" => $explode_target[2],
                "Q4" => $explode_target[3]
            ),
            "realisasi" => array(
                "Q1" => $explode_realisasi[0],
                "Q2" => $explode_realisasi[1],
                "Q3" => $explode_realisasi[2],
                "Q4" => $explode_realisasi[3]
            ),
            "capaian" => array(
                "Q1" => $explode_capaian[0],
                "Q2" => $explode_capaian[1],
                "Q3" => $explode_capaian[2],
                "Q4" => $explode_capaian[3]
            )
        );

        return $data_tabel;
    }

    public static function getTabelList($main, $sub)
    {
        $row = DB::table('iku')->where(array('main' => $main, 'sub' => $sub))->first();

        $tabel_list = array();
        $results = DB::select("select RT.*, tabel.* from referensi_tabel as RT 
        INNER JOIN tabel
        ON RT.id_tabel = tabel.id
        where RT.id_iku = $row->id");

        foreach ($results as $row) {
            $explode_target = explode("#", $row->target);
            $explode_realisasi = explode("#", $row->realisasi);
            $explode_capaian = explode("#", $row->capaian);

            $data_tabel = array(
                "judul_tabel" => $row->judul_tabel,
                "main_iku" => $row->main_iku,
                "id_tabel" => $row->id_tabel,
                "target" => array(
                    "Q1" => $explode_target[0],
                    "Q2" => $explode_target[1],
                    "Q3" => $explode_target[2],
                    "Q4" => $explode_target[3]
                ),
                "realisasi" => array(
                    "Q1" => $explode_realisasi[0],
                    "Q2" => $explode_realisasi[1],
                    "Q3" => $explode_realisasi[2],
                    "Q4" => $explode_realisasi[3]
                ),
                "capaian" => array(
                    "Q1" => $explode_capaian[0],
                    "Q2" => $explode_capaian[1],
                    "Q3" => $explode_capaian[2],
                    "Q4" => $explode_capaian[3]
                )
            );

            array_push($tabel_list, $data_tabel);
        }

        return $tabel_list;
    }
}
