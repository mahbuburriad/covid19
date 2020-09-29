<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContinentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('continents', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('updated')->nullable();
            $table->string('cases')->nullable();
            $table->string('todayCases')->nullable();
            $table->string('deaths')->nullable();
            $table->string('todayDeaths')->nullable();
            $table->string('recovered')->nullable();
            $table->string('todayRecovered')->nullable();
            $table->string('active')->nullable();
            $table->string('critical')->nullable();
            $table->string('casesPerOneMillion')->nullable();
            $table->string('deathsPerOneMillion')->nullable();
            $table->string('tests')->nullable();
            $table->string('testsPerOneMillion')->nullable();
            $table->string('population')->nullable();
            $table->string('continent')->nullable();
            $table->string('activePerOneMillion')->nullable();
            $table->string('recoveredPerOneMillion')->nullable();
            $table->string('criticalPerOneMillion')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->text('countries')->nullable();
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
        Schema::dropIfExists('continents');
    }
}
