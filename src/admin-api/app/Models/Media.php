<?php

namespace App\Models;

class Media extends AppModel
{
    public $search = [
      'name',
      'filename'
    ];

    protected $fillable = [
        'name',
        'description',
        'original_filename',
        'documentable_id',
        'documentable_type',
        'original_filename',
        'filename',
        'filesize',
        'mime_type',
        'uploaded_by_id'
    ];

    protected $with = [
        'user'
    ];

    public function documentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

