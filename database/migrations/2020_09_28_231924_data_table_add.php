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
