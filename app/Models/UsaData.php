<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsaData extends Model
{
    use HasFactory;

    protected $fillable = [
        'updated', 'todayCases', 'deaths', 'todayDeaths', 'active',
        'casesPerOneMillion', 'deathsPerOneMillion', 'tests', 'testsPerOneMillion',
        'population', 'state', 'cases', 'date'
    ];
}
