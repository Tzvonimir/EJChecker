<?php

namespace App\Models;

class AppModel extends \Eloquent
{
    public $search = [];
    protected $fillable = [];

    /**
     * Used in 'with' whenever there is a need for a detailed record.
     * Used in 'show' methods, for example.
     */
    protected $details = [];
}
