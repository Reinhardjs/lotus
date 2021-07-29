<?php

namespace App\Http\Controllers\pages\intelijen;;

use App\Http\Controllers\Controller;
use App\Models\basic\CrudModel;

class ProfilPenggunaJasaController extends Controller
{

    public $table_name = "profil_pengguna_jasa";

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

        return view("pages.intelijen.profil_pengguna_jasa.read", $data);
    }

    public function create()
    {
        $data = array(
            "table_name" => $this->table_name
        );

        return view("pages.intelijen.profil_pengguna_jasa.create", $data);
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

        return view("pages.intelijen.profil_pengguna_jasa.update", $data);
    }
}
