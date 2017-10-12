<?php

namespace App\Models;

class Currency extends AppModel
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