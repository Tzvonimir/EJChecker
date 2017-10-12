<?php

namespace App\Models;

class Role extends AppModel
{
    public function actions()
    {
        return $this->belongsToMany(Action::class)->withTimestamps();
    }
}
