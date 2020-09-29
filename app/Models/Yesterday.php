<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yesterday extends Model
{
    use HasFactory;

    protected $fillable = [
        'country', 'total_cases', 'new_cases', 'total_deaths', 'new_deaths', 'total_recovered', 'new_recovered',
        'active_cases', 'serious', 'tot_cases', 'death1m', 'total_tests', 'test1m', 'population', 'date',
        'updated', 'iso2', 'iso3', 'lat', 'long', 'flag', 'continent', 'oneCasePerPeople',
        'oneDeathPerPeople', 'oneTestPerPeople', 'activePerOneMillion', 'recoveredPerOneMillion', 'criticalPerOneMillion'
    ];
}
