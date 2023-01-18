<?php

namespace App\Models;

use App\Models\User;
use App\Models\Event;
use App\Models\EntryNotes;
use App\Models\Nomination;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entry extends Model implements HasMedia
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;
    use RevisionableTrait;
    use InteractsWithMedia;

    const STATUS_DRAFT      = 0;
    const STATUS_MODERATION = 1;
    const STATUS_RETURNED   = 2;
    const STATUS_REJECTED   = 3;
    const STATUS_PUBLISHED  = 4;
    const STATUS_FINAL      = 6;
    const STATUS_WINNER     = 7;

    protected $fillable = [
        'title',
        'full_title',
        'description',
        'body',
        'organization',
        'link',
        'place',
        'status',
        'nomination_id',
        'event_id',
        'image',
        'files'
    ];

    protected $keepRevisionOf = [
        'title',
        'full_title',
        'description',
        'body',
        'organization',
        'link'
    ];

    public static function listReadableStatus()
    {
        return [
            self::STATUS_DRAFT       => 'Черновик',
            self::STATUS_MODERATION  => 'На модерации',
            self::STATUS_RETURNED    => 'Возвращено на доработку',
            self::STATUS_REJECTED    => 'Отклонено',
            self::STATUS_PUBLISHED   => 'Опубликовано',
            self::STATUS_FINAL       => 'Финальный отбор',
            self::STATUS_WINNER      => 'Финалист'
        ];
    }

    public function identifiableName()
    {
        return $this->title;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nomination()
    {
        return $this->belongsTo(Nomination::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function members()
    {
        return $this->hasMany(EntryMembers::class)->orderBy('sort');
    }

    public function notes()
    {
        return $this->hasMany(EntryNotes::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);

        $this->addMediaCollection('files');
    }

    public function getImageAttribute()
    {
        $media = $this->getFirstMedia('image');

        return $media ? $media->id.'/'.$media->file_name : '';
    }

    public function setImageAttribute($file)
    {
        $this->clearMediaCollection('image');

        if ($file) {
            $this->addMedia($file)
                ->usingFileName($file->hashName())
                ->toMediaCollection('image');
        }
    }

    public function getFilesAttribute()
    {
        $media = $this->getMedia('files');

        if (! $media) {
            return [];
        }

        $list = [];
        foreach ($media as $file) {
            $list[] = $file->id.'/'.$file->file_name;
        }

        return $list;
    }

    public function setFilesAttribute($files)
    {
        //$this->clearMediaCollection('files');

        /*if ($file) {
            $this->addMedia($file)
                ->usingName($file->getClientOriginalName())
                ->usingFileName($file->hashName())
                ->toMediaCollection('image');
        }*/
    }

    /*public function setPosterAttribute($value)
    {
        $attribute_name = 'poster';
        $disk = 'public';
        $destination_path = 'entry';

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function setFilesAttribute($value)
    {
        $attribute_name = 'files';
        $disk = 'public';
        $destination_path = 'entry';

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }*/
}
