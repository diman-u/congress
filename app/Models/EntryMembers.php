<?php

namespace App\Models;

use App\Models\Entry;
use Spatie\MediaLibrary\HasMedia;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\InteractsWithMedia;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntryMembers extends Model implements HasMedia, Sortable
{
    use HasFactory;
    use CrudTrait;
    use InteractsWithMedia;
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'name',
        'position',
        'city'
    ];

    public function buildSortQuery()
    {
        return static::query()->where('entry_id', $this->entry_id);
    }

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);

        $this->addMediaConversion('thumb')
            ->width(250)
            ->height(250);
    }
}
