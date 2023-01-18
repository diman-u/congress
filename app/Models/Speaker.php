<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'fio',
        'position',
        'body',
        'image'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function eventsExpertAssigned()
    {
        return $this->belongsToMany(Event::class, 'event_expert', 'expert_id');
    }

    public function program()
    {
        return $this->belongsToMany(Program::class);
    }

    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $disk = 'public';
        $destination_path = 'speakers';

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path, $fileName = null);
    }
}
