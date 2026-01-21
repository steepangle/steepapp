<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchiveItem extends Model
{
    protected $fillable = [
        'title',
        'file_path',
        'access_level',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function isPublic(): bool
    {
        return $this->access_level === 'public';
    }
}