<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $disk = 'public';
        $destination_path = 'nomination';

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
