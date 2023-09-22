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
        Schema::create('tr_ruangan', function (Blueprint $table) {
            $table->unsignedInteger('id_trruangan')->autoIncrement();
            $table->string('kelas', 10);
            $table->unsignedInteger('id_ruangan');
            $table->timestamps();
        });

        Schema::table('tr_ruangan', function ($table) {
            $table
                ->foreign('id_ruangan')
                ->references('id_ruangan')
                ->on('ruangan')
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
        Schema::dropIfExists('tr_ruangan');
    }
};
