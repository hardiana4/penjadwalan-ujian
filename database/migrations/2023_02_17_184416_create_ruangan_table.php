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
        Schema::create('ruangan', function (Blueprint $table) {
            $table->unsignedInteger('id_ruangan')->autoIncrement();
            $table->string('ruangan', 10);
            $table->unsignedInteger('id_gedung');
            $table->timestamps();
        });

        Schema::table('ruangan', function ($table) {
            $table
                ->foreign('id_gedung')
                ->references('id_gedung')
                ->on('gedung')
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
        Schema::dropIfExists('ruangan');
    }
};
