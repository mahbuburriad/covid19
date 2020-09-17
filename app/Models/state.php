<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class state extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'country', 'state', 'district', 'numberOfPeople'];

/*    protected static function booted()
    {
        static::addGlobalScope(new numberScope);
    }*/

/*    protected static function booted()
    {
        static::addGlobalScope('age', function (Builder $builder) {
            $builder->where('numberOfPeople', '<', 200);
        });
    }*/
}


/*class numberScope implements scope{

    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $builder->where('numberOfPeople', '<', 200);
    }
}*/
