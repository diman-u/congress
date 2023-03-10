<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'gallery_id',
        'path',
    ];
}
