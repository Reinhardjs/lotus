<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetaKerawananBkcIlegalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peta_kerawanan_bkc_ilegal', function (Blueprint $table) {
            $table->increments('id');
            $table->string("deskripsi");
            $table->string("img_url");
            $table->string("koordinat");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peta_kerawanan_bkc_ilegal');
    }
}
