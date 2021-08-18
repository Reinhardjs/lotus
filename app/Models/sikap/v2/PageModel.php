<?php

namespace App\Models\sikap\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageModel extends Model
{

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


            $row2018 = collect(\DB::select("SELECT RT.id_iku, RT.main_iku, RT.id_tabel, t.* FROM referensi_tabel as RT
            INNER JOIN tabel t ON RT.id_tabel = t.id 
            WHERE RT.id_iku='{$row->id_iku}' and RT.main_iku='nko2018'"))->first();

            if ($row2018 != null) {
                $explode_capaian = explode("#", $row2018->capaian);
                $explode_realisasi = explode("#", $row2018->realisasi);
                array_push($data_grafik[0]["data"]["nko2018"], str_replace(",", ".", $explode_capaian[3])); // capaian [3] -> Q4
                array_push($data_grafik[1]["data"]["nko2018"], str_replace(",", ".", $explode_realisasi[3])); // realisasi [3] -> Q4
            } else {
                array_push($data_grafik[0]["data"]["nko2018"], "0.0"); // capaian [3] -> Q4
                array_push($data_grafik[1]["data"]["nko2018"], "0.0"); // realisasi [3] -> Q4
            }

            $row2019 = collect(\DB::select("SELECT RT.id_iku, RT.main_iku, RT.id_tabel, t.* FROM referensi_tabel as RT
            INNER JOIN tabel t ON RT.id_tabel = t.id 
            WHERE RT.id_iku='{$row->id_iku}' and RT.main_iku='nko2019'"))->first();

            if ($row2019 != null) {
                $explode_capaian = explode("#", $row2019->capaian);
                $explode_realisasi = explode("#", $row2019->realisasi);
                array_push($data_grafik[0]["data"]["nko2019"], str_replace(",", ".", $explode_capaian[3])); // capaian [3] -> Q4
                array_push($data_grafik[1]["data"]["nko2019"], str_replace(",", ".", $explode_realisasi[3])); // realisasi [3] -> Q4
            } else {
                array_push($data_grafik[0]["data"]["nko2019"], "0.0"); // capaian [3] -> Q4
                array_push($data_grafik[1]["data"]["nko2019"], "0.0"); // realisasi [3] -> Q4
            }

            $row2020 = collect(\DB::select("SELECT RT.id_iku, RT.main_iku, RT.id_tabel, t.* FROM referensi_tabel as RT
            INNER JOIN tabel t ON RT.id_tabel = t.id 
            WHERE RT.id_iku='{$row->id_iku}' and RT.main_iku='nko2020'"))->first();

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
}
