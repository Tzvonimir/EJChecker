<?php

namespace App\Models;


class AppConfiguration extends AppModel
{
    public $search = [
        'key'
    ];

    protected $fillable = [
        'user_id',
        'key',
        'value'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}