<?php

namespace App\Http\Controllers\basic;

use App\Http\Controllers\Controller;
use App\Models\basic\CrudModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        unset($_POST['_token']);
    }

    public function get_all()
    {
        $table_name = $_POST["table_name"];
        $response = array();

        $rows = CrudModel::getAll($table_name);
        if ($rows != null) {
            $response["success"] = true;
            $response["message"] = "Data berhasil ditambah";
            $response["data"] = $rows;
        } else {
            $response["success"] = false;
            $response["message"] = "Data gagal ditambah";
            $response["data"] = null;
        }

        echo json_encode($response);
    }

    public function process_add(Request $request)
    {
        $data = array();
        $response = array();

        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        unset($data["table_name"]);

        $table_name = $_POST["table_name"];

        if ($request->hasFile('img_url')) {
            //  Let's do everything here
            if ($request->file('img_url')->isValid()) {
                $extension = $request->img_url->extension();
                $request->img_url->storeAs('/public/images', date("d-m-Y") . "-" . time() . "." . $extension);
                // $url = Storage::url("file-name" . "." . $extension);
                $url = asset('storage/images/' . date("d-m-Y") . "-" . time() . "." . $extension);
                $data["img_url"] = $url;
            }
        }

        if (CrudModel::add($table_name, $data) > -1) {
            $response["success"] = true;
            $response["message"] = "Data berhasil ditambah";
        } else {
            $response["success"] = false;
            $response["message"] = "Data gagal ditambah";
        }

        echo json_encode($response);
    }

    public function process_update(Request $request)
    {
        $data = array();
        $response = array();

        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        unset($data["id"]);
        unset($data["table_name"]);

        $id = $_POST["id"];
        $table_name = $_POST["table_name"];
        $where = array(
            "id" => $id
        );

        if ($request->hasFile('img_url')) {
            //  Let's do everything here
            if ($request->file('img_url')->isValid()) {

                $url = CrudModel::getRow($table_name, array("id" => $id))->img_url;
                $url_var = explode('/', $url);
                $last_path = end($url_var);
                Storage::delete("public/images/$last_path");


                $extension = $request->img_url->extension();
                $request->img_url->storeAs('/public/images', date("d-m-Y") . "-" . time() . "." . $extension);
                // $url = Storage::url("file-name" . "." . $extension);
                $url = asset('storage/images/' . date("d-m-Y") . "-" . time() . "." . $extension);
                $data["img_url"] = $url;
            }
        }

        if (CrudModel::update($table_name, $data, $where) > -1) {
            $response["success"] = true;
            $response["message"] = "Data berhasil diubah";
        } else {
            $response["success"] = false;
            $response["message"] = "Data gagal diubah";
        }

        echo json_encode($response);
    }

    public function process_delete()
    {
        $response = array();

        $id = $_POST["id"];
        $table_name = $_POST["table_name"];
        $where = array(
            "id" => $id
        );

        if (CrudModel::delete($table_name, $where) > 0) {
            $response["success"] = true;
            $response["message"] = "Data berhasil dihapus";
        } else {
            $response["success"] = false;
            $response["message"] = "Data gagal gagal";
        }

        echo json_encode($response);
    }
}
