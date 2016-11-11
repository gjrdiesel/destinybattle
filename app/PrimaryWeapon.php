<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PrimaryWeapon extends Model {

    protected $table = 'inventory_items';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('primaryWeapon', function(Builder $builder) {
            $builder->where('bucketTypeHash', 1498876634);
        });
    }
}