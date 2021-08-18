<?php

namespace App\Http\Controllers\kinerja\indikator_kerja_utama;

use App\Http\Controllers\Controller;
use App\Models\sikap\v2\PageModel;

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
        $data_grafik = PageModel::getDataGrafikV2();
        $data = array(
            "data_grafik" => $data_grafik
        );

        return view("sikap.v2.dashboard", $data);
    }
}
