<?php

namespace App\Models;

class Country extends AppModel
{
    public $search = [
        'iso',
        'name'
    ];

    protected $fillable = [
        'iso',
        'name'
    ];
}

