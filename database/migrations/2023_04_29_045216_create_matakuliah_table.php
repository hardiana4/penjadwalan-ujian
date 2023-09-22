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
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->unsignedInteger('id_matakuliah')->autoIncrement();
            $table->unsignedInteger('id_prodi');
            $table->enum('semester',['I (Satu)','II (Dua)','III (Tiga)','IV (Empat)','V (Lima)','VI (Enam)','VII (Tujuh)','VIII (Delapan)']);
            $table->string('matakuliah', 50);
            $table->timestamps();
        });

        Schema::table('matakuliah', function ($table) {
            $table
                ->foreign('id_prodi')
                ->references('id_prodi')
                ->on('prodi')
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
        Schema::dropIfExists('matakuliah');
    }
};
