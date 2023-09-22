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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->unsignedInteger('id_mahasiswa')->autoIncrement();
            $table->unsignedInteger('id_pengawas');
            $table->unsignedInteger('id_prodi');
            $table->string('nama_mahasiswa', 50);
            $table->string('npm', 20);
            $table->enum('semester',['I (Satu)','II (Dua)','III (Tiga)','IV (Empat)','V (Lima)','VI (Enam)','VII (Tujuh)','VIII (Delapan)']);
            $table->enum('kode_kelas',["A","B","C","D"]);
            $table->string('kelas', 10);
            $table->enum('status',['0','1']);
            $table->string('SPI',20)->nullable();
            $table->string('UKT', 20)->nullable();
            $table->timestamps();
        });

        Schema::table('mahasiswa', function ($table) {
            $table
                ->foreign('id_prodi')
                ->references('id_prodi')
                ->on('prodi')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('mahasiswa', function ($table) {
            $table
                ->foreign('id_pengawas')
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
        Schema::dropIfExists('mahasiswa');
    }
};
