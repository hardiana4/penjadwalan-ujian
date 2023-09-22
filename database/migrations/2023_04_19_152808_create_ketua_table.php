ke<?php

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
        Schema::create('ketua', function (Blueprint $table) {
            $table->unsignedInteger('id_ketua')->autoIncrement();
            $table->unsignedInteger('id_users');
            $table->string('nip', 20);
            $table->string('ttd', 50)->nullable();
            $table->string('tgl', 20);
            $table->string('tgl_sah', 30);
            $table->timestamps();
        });

        Schema::table('ketua', function ($table) {
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
        Schema::dropIfExists('ketua');
    }
};
