<?php

namespace App\Http\Controllers\kinerja\dashboard;

use App\Http\Controllers\Controller;
use App\Models\sikap\ProcessModel;

class Process extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		unset($_POST['_token']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('dashboard.homepage');
	}

	public function sub_main_add()
	{
		$data = array();

		$judul_tabel = $_POST["judul_tabel"];
		$data_tabel = $_POST["tabel"];
		$tabel_lain = $_POST["tabel_lain"] ?? array();

		unset($_POST["judul_tabel"]);
		unset($_POST["tabel"]);
		unset($_POST["files"]);
		if (isset($_POST["tabel_lain"])) unset($_POST["tabel_lain"]);

		$inserted_id_iku = ProcessModel::addIku($_POST);
		ProcessModel::addTabel($inserted_id_iku, $judul_tabel, $data_tabel);
		ProcessModel::addTabelLain($inserted_id_iku, $tabel_lain);

		$data["success"] = true;
		$data["message"] = "Data berhasil ditambah";

		echo json_encode($data);
	}

	public function sub_main_update()
	{
		$data = array();

		$judul_tabel = $_POST["judul_tabel"];
		$data_tabel = $_POST["tabel"];
		$tabel_lain = $_POST["tabel_lain"] ?? array();

		unset($_POST["judul_tabel"]);
		unset($_POST["tabel"]);
		unset($_POST["files"]);
		if (isset($_POST["tabel_lain"])) unset($_POST["tabel_lain"]);

		$id = $_POST["id"];
		unset($_POST["id"]);

		$isSuccess = ProcessModel::updateIku($_POST, $id);
		$isSuccess2 = ProcessModel::updateTabel($id, $judul_tabel, $data_tabel);
		ProcessModel::updateTabelLain($id, $tabel_lain);

		if ($isSuccess || $isSuccess2) {
			$data["success"] = true;
			$data["message"] = "Data berhasil diubah";
		} else {
			$data["message"] = "Tidak ada data yang diubah";
		}

		echo json_encode($data);
	}
}
