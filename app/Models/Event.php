<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'title',
        'is_active'
    ];

    public static function active()
    {
        return static::where('is_active', 1)->first();
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function nominations()
    {
        return $this->belongsToMany(Nomination::class);
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class);
    }

    public function experts()
    {
        return $this->belongsToMany(Speaker::class, 'event_expert', 'event_id', 'expert_id');
    }
}
