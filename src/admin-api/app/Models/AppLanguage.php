<?php

namespace App\Models;


class AppLanguage extends AppModel
{
    protected $fillable = [
        'name'
    ];

    public $search = [
        'name'
    ];

}