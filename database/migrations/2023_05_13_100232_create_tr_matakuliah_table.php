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
        Schema::create('tr_matakuliah', function (Blueprint $table) {
            $table->unsignedInteger('id_trmatakuliah')->autoIncrement();
            $table->unsignedInteger('id_prodi');
            $table->enum('semester',['I (Satu)','II (Dua)','III (Tiga)','IV (Empat)','V (Lima)','VI (Enam)','VII (Tujuh)','VIII (Delapan)']);
            $table->unsignedInteger('id_matakuliah');
            $table->unsignedInteger('id_pengawas');
            $table->enum('kode_kelas',['A','B','C','D']);
            $table->string('kelas', 10);
            $table->string('tgl_ujian', 20);
            $table->string('hari', 10);
            $table->unsignedInteger('id_sesi');
            $table->timestamps();
        });

        Schema::table('tr_matakuliah', function ($table) {
            $table
                ->foreign('id_prodi')
                ->references('id_prodi')
                ->on('prodi')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('tr_matakuliah', function ($table) {
            $table
                ->foreign('id_matakuliah')
                ->references('id_matakuliah')
                ->on('matakuliah')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('tr_matakuliah', function ($table) {
            $table
                ->foreign('id_pengawas')
                ->references('id_pengawas')
                ->on('pengawas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('tr_matakuliah', function ($table) {
            $table
                ->foreign('id_sesi')
                ->references('id_sesi')
                ->on('sesi')
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
        Schema::dropIfExists('tr_matakuliah');
    }
};
