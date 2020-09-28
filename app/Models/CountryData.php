<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryData extends Model
{
    use HasFactory;

    protected $fillable = [
        'updated', 'country', 'iso2', 'iso3',
        'lat', 'long', 'flag', 'cases',
        'todayCases', 'deaths', 'todayDeaths', 'recovered',
        'todayRecovered', 'active', 'critical', 'casesPerOneMillion',
        'deathsPerOneMillion', 'tests', 'testsPerOneMillion', 'population',
        'continent', 'oneCasePerPeople', 'oneDeathPerPeople', 'oneTestPerPeople',
        'activePerOneMillion', 'recoveredPerOneMillion', 'criticalPerOneMillion'
    ];
}
