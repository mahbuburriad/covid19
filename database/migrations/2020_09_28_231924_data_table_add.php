<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataTableAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->string('updated')->nullable()->after('id');
            $table->string('todayCases')->nullable()->after('numberOfPeople');
            $table->string('deaths')->nullable()->after('todayCases');
            $table->string('todayDeaths')->nullable()->after('deaths');
            $table->string('active')->nullable()->after('todayDeaths');
            $table->string('casesPerOneMillion')->nullable()->after('active');
            $table->string('deathsPerOneMillion')->nullable()->after('casesPerOneMillion');
            $table->string('tests')->nullable()->after('deathsPerOneMillion');
            $table->string('testsPerOneMillion')->nullable()->after('tests');
            $table->string('population')->nullable()->after('testsPerOneMillion');
            $table->string('case_yesterday')->nullable()->after('population');
            $table->string('death_yesterday')->nullable()->after('case_yesterday');
            $table->string('recovered_yesterday')->nullable()->after('death_yesterday');
        });

        Schema::table('data', function (Blueprint $table) {
            $table->string('state')->nullable()->after('country');
            $table->string('updatedAt')->nullable()->after('id');
            $table->string('latitude')->nullable()->after('state');
            $table->string('longitude')->nullable()->after('latitude');
            $table->string('province')->nullable()->after('death');
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
