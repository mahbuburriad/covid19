<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LiveYesterdayAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lives', function (Blueprint $table) {
            $table->string('updated')->nullable()->after('id');
            $table->string('iso2')->nullable()->after('country');
            $table->string('iso3')->nullable()->after('country');
            $table->string('lat')->nullable()->after('country');
            $table->string('long')->nullable()->after('country');
            $table->string('flag')->nullable()->after('country');
            $table->string('continent')->nullable()->after('country');
            $table->string('oneCasePerPeople')->nullable()->after('population');
            $table->string('oneDeathPerPeople')->nullable()->after('population');
            $table->string('oneTestPerPeople')->nullable()->after('population');
            $table->string('activePerOneMillion')->nullable()->after('population');
            $table->string('recoveredPerOneMillion')->nullable()->after('population');
            $table->string('criticalPerOneMillion')->nullable()->after('population');
        });

        Schema::table('yesterdays', function (Blueprint $table) {
            $table->string('updated')->nullable()->after('date');
            $table->string('iso2')->nullable()->after('country');
            $table->string('iso3')->nullable()->after('country');
            $table->string('lat')->nullable()->after('country');
            $table->string('long')->nullable()->after('country');
            $table->string('flag')->nullable()->after('country');
            $table->string('continent')->nullable()->after('country');
            $table->string('oneCasePerPeople')->nullable()->after('population');
            $table->string('oneDeathPerPeople')->nullable()->after('population');
            $table->string('oneTestPerPeople')->nullable()->after('population');
            $table->string('activePerOneMillion')->nullable()->after('population');
            $table->string('recoveredPerOneMillion')->nullable()->after('population');
            $table->string('criticalPerOneMillion')->nullable()->after('population');
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
