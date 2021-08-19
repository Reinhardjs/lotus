<?php

namespace App\Http\Controllers\kinerja\analisis_iku;

use App\Http\Controllers\Controller;
use App\Models\sikap\v3\PageModel;

class Page extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_grafik = PageModel::getDataGrafikV3();
        $data = array(
            "data_grafik" => $data_grafik
        );

        return view("sikap.v3.dashboard", $data);
    }

    public function main($id)
    {
        // Read
        $rows = PageModel::getSubs($id);
        $data = array(
            "rows" => $rows,
            "main" => $id
        );
        return view("sikap.v3.main.sub_list", $data);
    }

    public function sub_update($main, $sub)
    {
        $row = PageModel::getSub($main, $sub);
        $data_tabel = PageModel::getTabel($main, $sub);

        $data = array(
            "row" => $row,
            "data_tabel" => $data_tabel
        );

        return view("sikap.v3.sub_main.update", $data);
    }
}
