<?php

namespace App\Models;

class ExtraNumber extends AppModel
{
    public $search = [
      'number'
    ];

    protected $fillable = [
        'number'
    ];

    protected $with = [
        'media'
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'documentable');
    }

}

