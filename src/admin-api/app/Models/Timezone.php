<?php

namespace App\Models;

class Timezone extends AppModel
{
    protected $fillable = [
        'name'
    ];

    public $search = [
        'name'
    ];
}