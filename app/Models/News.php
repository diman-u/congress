<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class News extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'body',
        'categories',
        'image',
        'event_id'
    ];

    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $disk = 'public';
        $destination_path = 'news';

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path, $fileName = null);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
