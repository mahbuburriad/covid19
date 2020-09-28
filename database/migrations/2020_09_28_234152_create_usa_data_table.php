<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsaDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usa_data', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('state');
            $table->string('updated')->nullable();
            $table->string('cases')->nullable();
            $table->string('todayCases')->nullable();
            $table->string('deaths')->nullable();
            $table->string('todayDeaths')->nullable();
            $table->string('active')->nullable();
            $table->string('casesPerOneMillion')->nullable();
            $table->string('deathsPerOneMillion')->nullable();
            $table->string('tests')->nullable();
            $table->string('testsPerOneMillion')->nullable();
            $table->string('population')->nullable();
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
        Schema::dropIfExists('usa_data');
    }
}
