<?php

namespace App\Models\sikap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProcessModel extends Model
{

    public static function addTabelLain($id_iku, $tabel_lain_list)
    {
        foreach ($tabel_lain_list as $item) {
            $id_tabel = $item["id_tabel"];
            $main_iku = $item["main"];

            $data = array(
                "id_iku" => $id_iku,
                "id_tabel" => $id_tabel,
                "main_iku" => $main_iku
            );
            DB::table("referensi_tabel")->insert($data);
        }
    }

    public static function updateTabelLain($id_iku, $tabel_lain_list)
    {
        $rows = DB::select("select * from referensi_tabel where id_iku=$id_iku");

        // Jangan ubah ubah tabelnya sendiri di row 1
        array_shift($rows);

        foreach ($rows as $row) {
            if (count($tabel_lain_list) > 0) {
                $first = array_shift($tabel_lain_list);
                $id_tabel = $first["id_tabel"];
                $main_iku = $first["main"];

                $data = array(
                    "id_tabel" => $id_tabel,
                    "main_iku" => $main_iku
                );
                DB::table("referensi_tabel")->where('id', $row->id)->update($data);
            } else {
                // Enggak dihapus, cuma dikosongkan aja
                $data = array(
                    "id_tabel" => "-1",
                    "main_iku" => "-1"
                );
                DB::table("referensi_tabel")->where('id', $row->id)->update($data);
            }
        }

        foreach ($tabel_lain_list as $item) {
            $id_tabel = $item["id_tabel"];
            $main_iku = $item["main"];

            $data = array(
                "id_iku" => $id_iku,
                "id_tabel" => $id_tabel,
                "main_iku" => $main_iku
            );
            DB::table("referensi_tabel")->insert($data);
        }

        return 1;
    }

    public static function addTabel($id_iku, $judul_tabel, $data_tabel)
    {
        $data = array(
            "judul_tabel" => $judul_tabel,
            "target" => $data_tabel["target"]["Q1"] . "#" . $data_tabel["target"]["Q2"] . "#" . $data_tabel["target"]["Q3"] . "#" . $data_tabel["target"]["Q4"],
            "realisasi" => $data_tabel["realisasi"]["Q1"] . "#" . $data_tabel["realisasi"]["Q2"] . "#" . $data_tabel["realisasi"]["Q3"] . "#" . $data_tabel["realisasi"]["Q4"],
            "capaian" => $data_tabel["capaian"]["Q1"] . "#" . $data_tabel["capaian"]["Q2"] . "#" . $data_tabel["capaian"]["Q3"] . "#" . $data_tabel["capaian"]["Q4"]
        );
        $inserted_id = DB::table('tabel')->insertGetId($data);

        $row = DB::table('iku')->where(array("id" => $id_iku))->first();

        $main_iku = $row->main;

        $data = array(
            "id_iku" => $id_iku,
            "id_tabel" => $inserted_id,
            "main_iku" => $main_iku
        );
        DB::table('referensi_tabel')->insert($data);

        // returning inserted id
        return $inserted_id;
    }

    public static function updateTabel($id_iku, $judul_tabel, $data_tabel)
    {
        $row = DB::table('referensi_tabel')->where(array("id_iku" => $id_iku))->first();

        $data = array(
            "judul_tabel" => $judul_tabel,
            "target" => $data_tabel["target"]["Q1"] . "#" . $data_tabel["target"]["Q2"] . "#" . $data_tabel["target"]["Q3"] . "#" . $data_tabel["target"]["Q4"],
            "realisasi" => $data_tabel["realisasi"]["Q1"] . "#" . $data_tabel["realisasi"]["Q2"] . "#" . $data_tabel["realisasi"]["Q3"] . "#" . $data_tabel["realisasi"]["Q4"],
            "capaian" => $data_tabel["capaian"]["Q1"] . "#" . $data_tabel["capaian"]["Q2"] . "#" . $data_tabel["capaian"]["Q3"] . "#" . $data_tabel["capaian"]["Q4"]
        );

        if (DB::table('tabel')->where(array('id' => $row->id_tabel))->update($data)) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function addIku($data)
    {
        // returning inserted id
        return DB::table("iku")->insertGetId($data);
    }

    public static function updateIku($data, $id)
    {
        if (DB::table("iku")->where('id', $id)->update($data)) {
            return 1;
        } else {
            return 0;
        }
    }
}
