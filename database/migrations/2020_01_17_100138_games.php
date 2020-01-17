<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Games extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('home_team_id');
            $table->unsignedInteger('home_score')->default(0);
            $table->unsignedInteger('visit_team_id');
            $table->unsignedInteger('visit_score')->default(0);
            $table->timestamps();
            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->foreign('visit_team_id')->references('id')->on('teams');
            $table->index(['id', 'home_team_id','visit_team_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
