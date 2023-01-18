<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'link',
        'image',
        'small',
        'title'
    ];

    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $disk = 'public';
        $destination_path = '/shows';

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path, $fileName = null);
    }
}
