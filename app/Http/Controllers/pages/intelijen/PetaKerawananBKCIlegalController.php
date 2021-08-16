<?php

namespace App\Http\Controllers\pages\intelijen;;

use App\Http\Controllers\Controller;
use App\Models\basic\CrudModel;

class PetaKerawananBKCIlegalController extends Controller
{

    public $sub_name = "intelijen";
    public $table_name = "peta_kerawanan_bkc_ilegal";

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
        $rows = CrudModel::getAll($this->table_name);
        $data = array(
            "rows" => $rows
        );

        return view("pages.{$this->sub_name}.{$this->table_name}.read", $data);
    }

    public function create()
    {
        $data = array(
            "table_name" => $this->table_name
        );

        return view("pages.{$this->sub_name}.{$this->table_name}.create", $data);
    }

    public function update($id)
    {
        $where = array(
            "id" => $id
        );

        $row = CrudModel::getRow($this->table_name, $where);

        $data = array(
            "row" => $row,
            "table_name" => $this->table_name,
        );

        return view("pages.{$this->sub_name}.{$this->table_name}.update", $data);
    }
}
