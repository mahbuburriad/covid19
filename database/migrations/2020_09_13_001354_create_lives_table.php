<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lives', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('total_cases')->nullable();
            $table->string('new_cases')->nullable();
            $table->string('total_deaths')->nullable();
            $table->string('new_deaths')->nullable();
            $table->string('total_recovered')->nullable();
            $table->string('new_recovered')->nullable();
            $table->string('active_cases')->nullable();
            $table->string('serious')->nullable();
            $table->string('tot_cases')->nullable();
            $table->string('death1m')->nullable();
            $table->string('total_tests')->nullable();
            $table->string('test1m')->nullable();
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
        Schema::dropIfExists('lives');
    }
}
