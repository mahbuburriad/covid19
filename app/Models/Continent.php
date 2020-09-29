<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    use HasFactory;

    protected $fillable = [
        'updated', 'cases', 'todayCases', 'deaths',
        'todayDeaths', 'recovered', 'todayRecovered', 'active',
        'critical', 'casesPerOneMillion', 'deathsPerOneMillion', 'tests',
        'testsPerOneMillion', 'population', 'continent', 'activePerOneMillion',
        'recoveredPerOneMillion', 'criticalPerOneMillion', 'lat', 'long', 'countries', 'date'
    ];
}
