<?php

namespace App\Models;

use App\Models\Entry;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntryNotes extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'note'
    ];

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}
