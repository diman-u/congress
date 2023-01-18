<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeCounter extends Model
{
    use HasFactory;

    protected $table = 'entry_likes';

    protected $fillable = [
        'entry_id',
        'phone',
        'status',
        'data',
        'entry_likes'
    ];
}
