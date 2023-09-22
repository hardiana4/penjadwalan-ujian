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
        Schema::create('pengawas', function (Blueprint $table) {
            $table->unsignedInteger('id_pengawas')->autoIncrement();
            $table->unsignedInteger('id_prodi');
            $table->unsignedInteger('id_users');
            $table->unsignedInteger('id_detail');
            $table->integer('kuota');
            $table->enum('jabatan',["Dosen","Teknisi"]);
            $table->timestamps();
        });

        Schema::table('pengawas', function ($table) {
            $table
                ->foreign('id_prodi')
                ->references('id_prodi')
                ->on('prodi')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('pengawas', function ($table) {
            $table
                ->foreign('id_users')
                ->references('id_users')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('pengawas', function ($table) {
            $table
                ->foreign('id_detail')
                ->references('id_detail')
                ->on('detail')
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
        Schema::dropIfExists('pengawas');
    }
};
