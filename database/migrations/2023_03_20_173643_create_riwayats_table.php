<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa');
            $table->string('nama_siswa');
            $table->string('ipa_grade');
            $table->string('mtk_grade');
            $table->string('ips_grade');
            $table->string('nilai_tes');
            $table->string('hasil');
            $table->string('hasil_uji');
            $table->integer('id_rule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayats');
    }
};