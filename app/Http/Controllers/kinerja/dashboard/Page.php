<?php

namespace App\Http\Controllers\kinerja\dashboard;

use App\Http\Controllers\Controller;
use App\Models\sikap\PageModel;

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
        return view("sikap.v1.dashboard");
    }

    public function main($id)
    {
        if ($id == "create") {
            // Create
            view("sikap.v1.main.create");
        } else if ($id == "update") {
            view("sikap.v1.sub_main.update");
        } else {
            // Read
            $rows = PageModel::getSubs($id);
            $data = array(
                "rows" => $rows,
                "main" => $id
            );
            return view("sikap.v1.main.sub_list", $data);
        }
    }

    public function sub($main, $sub)
    {
        if ($sub == "create") {

            // Create
            $data = array("main" => $main);
            view("sikap.v1.sub_main.create", $data);
        } else {

            // Read
            $row = PageModel::getSub($main, $sub);
            $tabel_list = PageModel::getTabelList($main, $sub);

            $data = array(
                "row" => $row,
                "tabel_list" => $tabel_list
            );

            return view("sikap.v1.sub_main.read", $data);
        }
    }

    public function main_update($main)
    {
        view("sikap.base.header");
        view("sikap.base.sidebar");

        $row = PageModel::getMain($main);
        $data = array(
            "row" => $row
        );
        view("sikap.v1.main.update", $data);
    }

    public function sub_update($main, $sub)
    {
        $row = PageModel::getSub($main, $sub);
        $data_tabel = PageModel::getTabel($main, $sub);
        $tabel_list = PageModel::getTabelList($main, $sub);
        array_shift($tabel_list);

        $data = array(
            "row" => $row,
            "data_tabel" => $data_tabel,
            "tabel_list" => $tabel_list
        );

        return view("sikap.v1.sub_main.update", $data);
    }
}
