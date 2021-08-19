<?php

namespace App\Http\Controllers\kinerja\analisis_iku;

use App\Http\Controllers\Controller;
use App\Models\sikap\v3\ProcessModel;

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

	public function sub_main_update()
	{
		$data = array();

		$data_tabel = $_POST["tabel"];
		unset($_POST["tabel"]);

		$main = $_POST["main"];
		$sub = $_POST["sub"];
		unset($_POST["main"]);
		unset($_POST["sub"]);

		$isSuccess = false;
		if (ProcessModel::updateTabel($main, $sub, $data_tabel) == true) {
			$isSuccess = true;
		} else {
			$isSuccess = ProcessModel::addTabel($main, $sub, $data_tabel);
		}

		if ($isSuccess) {
			$data["success"] = true;
			$data["message"] = "Data berhasil diubah";
		}

		echo json_encode($data);
	}
}
