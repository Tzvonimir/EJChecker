<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'is_active',
        'company_position_id'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public $search = [
        'first_name',
        'last_name',
        'email'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'documentable');
    }
    
}
