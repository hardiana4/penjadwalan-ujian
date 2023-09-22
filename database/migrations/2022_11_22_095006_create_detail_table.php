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
        Schema::create('detail', function (Blueprint $table) {
            $table->unsignedInteger('id_detail')->autoIncrement();
            $table->unsignedInteger('id_users');
            $table->string('nama', 50);
            $table->timestamps();
        });

        Schema::table('detail', function ($table) {
            $table
                ->foreign('id_users')
                ->references('id_users')
                ->on('users')
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
        Schema::dropIfExists('detail');
    }
};
