<?php

namespace App\Models;

class City extends AppModel
{
    public $search = [
      'name'
    ];

    protected $fillable = [
        'name',
        'country_id'
    ];

    protected $with = [
        'country'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}

