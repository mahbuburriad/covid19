<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndiaDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('india_data', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('state')->nullable();
            $table->string('active')->nullable();
            $table->string('recovered')->nullable();
            $table->string('deaths')->nullable();
            $table->string('cases')->nullable();
            $table->string('todayActive')->nullable();
            $table->string('todayRecovered')->nullable();
            $table->string('todayDeaths')->nullable();
            $table->string('todayCases')->nullable();
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
        Schema::dropIfExists('india_data');
    }
}
