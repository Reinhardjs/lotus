<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilPenggunaJasaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_pengguna_jasa', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nama_importir");
            $table->string("alamat");
            $table->string("penanggungjawab_perusahaan");
            $table->string("riwayat_pemberitahuan_pabean");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profil_pengguna_jasa');
    }
}
