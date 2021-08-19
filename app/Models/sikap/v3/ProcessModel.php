<?php

namespace App\Models\sikap\v3;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProcessModel extends Model
{

    public static function addTabel($main, $sub, $data_tabel)
    {
        $data = array(
            "main" => $main,
            "sub" => $sub,
            "januari" => $data_tabel["januari"]["Q1"] . "#" . $data_tabel["januari"]["Q2"] . "#" . $data_tabel["januari"]["Q3"] . "#" . $data_tabel["januari"]["Q4"],
            "februari" => $data_tabel["februari"]["Q1"] . "#" . $data_tabel["februari"]["Q2"] . "#" . $data_tabel["februari"]["Q3"] . "#" . $data_tabel["februari"]["Q4"],
            "maret" => $data_tabel["maret"]["Q1"] . "#" . $data_tabel["maret"]["Q2"] . "#" . $data_tabel["maret"]["Q3"] . "#" . $data_tabel["maret"]["Q4"],
            "april" => $data_tabel["april"]["Q1"] . "#" . $data_tabel["april"]["Q2"] . "#" . $data_tabel["april"]["Q3"] . "#" . $data_tabel["april"]["Q4"],
            "mei" => $data_tabel["mei"]["Q1"] . "#" . $data_tabel["mei"]["Q2"] . "#" . $data_tabel["mei"]["Q3"] . "#" . $data_tabel["mei"]["Q4"],
            "juni" => $data_tabel["juni"]["Q1"] . "#" . $data_tabel["juni"]["Q2"] . "#" . $data_tabel["juni"]["Q3"] . "#" . $data_tabel["juni"]["Q4"],
            "juli" => $data_tabel["juli"]["Q1"] . "#" . $data_tabel["juli"]["Q2"] . "#" . $data_tabel["juli"]["Q3"] . "#" . $data_tabel["juli"]["Q4"],
            "agustus" => $data_tabel["agustus"]["Q1"] . "#" . $data_tabel["agustus"]["Q2"] . "#" . $data_tabel["agustus"]["Q3"] . "#" . $data_tabel["agustus"]["Q4"],
            "september" => $data_tabel["september"]["Q1"] . "#" . $data_tabel["september"]["Q2"] . "#" . $data_tabel["september"]["Q3"] . "#" . $data_tabel["september"]["Q4"],
            "oktober" => $data_tabel["oktober"]["Q1"] . "#" . $data_tabel["oktober"]["Q2"] . "#" . $data_tabel["oktober"]["Q3"] . "#" . $data_tabel["oktober"]["Q4"],
            "november" => $data_tabel["november"]["Q1"] . "#" . $data_tabel["november"]["Q2"] . "#" . $data_tabel["november"]["Q3"] . "#" . $data_tabel["november"]["Q4"],
            "desember" => $data_tabel["desember"]["Q1"] . "#" . $data_tabel["desember"]["Q2"] . "#" . $data_tabel["desember"]["Q3"] . "#" . $data_tabel["desember"]["Q4"],
        );
        $inserted_id = DB::table('data_v3')->insertGetId($data);

        // returning inserted id
        return $inserted_id;
    }

    public static function updateTabel($main, $sub, $data_tabel)
    {
        $row = DB::table('data_v3')->where(array(
            "main" => $main,
            "sub" => $sub
        ))->first();

        if ($row == null) { // no data found in data_v3
            return 0;
        }

        $data = array(
            "januari" => $data_tabel["januari"]["Q1"] . "#" . $data_tabel["januari"]["Q2"] . "#" . $data_tabel["januari"]["Q3"] . "#" . $data_tabel["januari"]["Q4"],
            "februari" => $data_tabel["februari"]["Q1"] . "#" . $data_tabel["februari"]["Q2"] . "#" . $data_tabel["februari"]["Q3"] . "#" . $data_tabel["februari"]["Q4"],
            "maret" => $data_tabel["maret"]["Q1"] . "#" . $data_tabel["maret"]["Q2"] . "#" . $data_tabel["maret"]["Q3"] . "#" . $data_tabel["maret"]["Q4"],
            "april" => $data_tabel["april"]["Q1"] . "#" . $data_tabel["april"]["Q2"] . "#" . $data_tabel["april"]["Q3"] . "#" . $data_tabel["april"]["Q4"],
            "mei" => $data_tabel["mei"]["Q1"] . "#" . $data_tabel["mei"]["Q2"] . "#" . $data_tabel["mei"]["Q3"] . "#" . $data_tabel["mei"]["Q4"],
            "juni" => $data_tabel["juni"]["Q1"] . "#" . $data_tabel["juni"]["Q2"] . "#" . $data_tabel["juni"]["Q3"] . "#" . $data_tabel["juni"]["Q4"],
            "juli" => $data_tabel["juli"]["Q1"] . "#" . $data_tabel["juli"]["Q2"] . "#" . $data_tabel["juli"]["Q3"] . "#" . $data_tabel["juli"]["Q4"],
            "agustus" => $data_tabel["agustus"]["Q1"] . "#" . $data_tabel["agustus"]["Q2"] . "#" . $data_tabel["agustus"]["Q3"] . "#" . $data_tabel["agustus"]["Q4"],
            "september" => $data_tabel["september"]["Q1"] . "#" . $data_tabel["september"]["Q2"] . "#" . $data_tabel["september"]["Q3"] . "#" . $data_tabel["september"]["Q4"],
            "oktober" => $data_tabel["oktober"]["Q1"] . "#" . $data_tabel["oktober"]["Q2"] . "#" . $data_tabel["oktober"]["Q3"] . "#" . $data_tabel["oktober"]["Q4"],
            "november" => $data_tabel["november"]["Q1"] . "#" . $data_tabel["november"]["Q2"] . "#" . $data_tabel["november"]["Q3"] . "#" . $data_tabel["november"]["Q4"],
            "desember" => $data_tabel["desember"]["Q1"] . "#" . $data_tabel["desember"]["Q2"] . "#" . $data_tabel["desember"]["Q3"] . "#" . $data_tabel["desember"]["Q4"],
        );

        if (DB::table('data_v3')->where(array("main" => $main, "sub" => $sub))->update($data)) {
            return 1;
        } else {
            return 0;
        }
    }

}
