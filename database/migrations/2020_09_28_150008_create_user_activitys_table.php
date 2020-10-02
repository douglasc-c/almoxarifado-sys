<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activitys', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->integer('user_id')->index()->unsigned();
            $table->integer('employeer_id')->nullable();
            $table->integer('equipament_id')->nullable();
            $table->string('description');
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
        Schema::dropIfExists('user_activitys');
    }
}
