<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTherapeuticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('therapeutics', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->text('medicationClass')->nullable();
            $table->text('tradeName')->nullable();
            $table->text('details')->nullable();
            $table->text('developerResearcher')->nullable();
            $table->text('sponsors')->nullable();
            $table->text('trialPhase')->nullable();
            $table->text('lastUpdate')->nullable();
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
        Schema::dropIfExists('therapeutics');
    }
}
