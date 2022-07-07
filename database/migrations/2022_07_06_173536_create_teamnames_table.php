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
        Schema::create('teamnames', function (Blueprint $table) {
            $table->id();
            $table->string('team_name');
            $table->string('name_of_manager');
            $table->integer('number_of_player');
            $table->string('logo')->nullable();
            $table->string('password');
            $table->foreignId('game_name_id')->constrained('game_names')->onDelete('cascade');
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
        Schema::dropIfExists('teamnames');
    }
};
