<?php

namespace App\Http\Controllers\sikap\v1;

use App\Http\Controllers\Controller;
use App\Models\sikap\DataModel;

class Data extends Controller
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

    public function getMainList()
    {
        $results = DataModel::getMainList();
        header('Content-Type: application/json');
        echo json_encode($results, JSON_PRETTY_PRINT);
    }

    public function getSubMainTableList($main)
    {
        $results = DataModel::getSubMainTableList($main);
        header('Content-Type: application/json');
        echo json_encode($results, JSON_PRETTY_PRINT);
    }
}
