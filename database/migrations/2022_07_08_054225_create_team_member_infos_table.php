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
        Schema::create('team_member_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('student_id')->unsigned()->unique();
            $table->foreignId('team_name_id')->constrained('teamnames')->onDelete('cascade');
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
        Schema::dropIfExists('team_member_infos');
    }
};
