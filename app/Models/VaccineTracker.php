<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineTracker extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'time', 'phase1', 'phase2', 'phase3', 'limited', 'approved'];
}
