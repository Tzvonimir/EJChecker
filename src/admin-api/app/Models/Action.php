<?php

namespace App\Models;

class Action extends AppModel
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
