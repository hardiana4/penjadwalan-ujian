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
        Schema::create('tr_jadwal', function (Blueprint $table) {
            $table->unsignedInteger('id_trjadwal')->autoIncrement();
            $table->unsignedInteger('id_tp');
            $table->unsignedInteger('id_trmatakuliah');
            $table->unsignedInteger('id_trruangan');
            $table->unsignedInteger('id_pengawas1');
            $table->unsignedInteger('id_pengawas2');
            $table->enum('jenis',['UTS','UAS']);
            $table->enum('kode',['FM.PUTSUTS-C.03-R0','FM.PUTSUAS-C.03-R0']);
            $table->timestamps();
        });

        Schema::table('tr_jadwal', function ($table) {
            $table
                ->foreign('id_tp')
                ->references('id_tp')
                ->on('tahun_pelajaran')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('tr_jadwal', function ($table) {
            $table
                ->foreign('id_trmatakuliah')
                ->references('id_trmatakuliah')
                ->on('tr_matakuliah')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('tr_jadwal', function ($table) {
            $table
                ->foreign('id_trruangan')
                ->references('id_trruangan')
                ->on('tr_ruangan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('tr_jadwal', function ($table) {
            $table
                ->foreign('id_pengawas1')
                ->references('id_pengawas')
                ->on('pengawas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('tr_jadwal', function ($table) {
            $table
                ->foreign('id_pengawas2')
                ->references('id_pengawas')
                ->on('pengawas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_jadwal');
    }
};
