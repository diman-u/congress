<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Program extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'time_end',
        'title',
        'info',
        'header',
        'moderators',
        'text',
        'summary',
        'video_id',
        'files',
        'preview',
        'is_payed'
    ];

    public function speaker()
    {
        return $this->belongsToMany(Speaker::class);
    }

    public function uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path)
    {
        $request = \Request::instance();
        $attribute_value = (array) $this->{$attribute_name};
        $files_to_clear = $request->get('clear_'.$attribute_name);
        if ($files_to_clear) {
            foreach ($files_to_clear as $filename) {
                \Storage::disk($disk)->delete($filename);
                $attribute_value = array_filter($attribute_value, function ($value) use ($filename) {
                    return $value != $filename;
                });
            }
        }
        // if a new file is uploaded, store it on disk and its filename in the database
        if ($request->hasFile($attribute_name)) {
            foreach ($request->file($attribute_name) as $file) {
                if ($file->isValid()) {
                    $new_file_name = $file->getClientOriginalName();
                    $file_path = $file->storeAs($destination_path, $new_file_name, $disk);
                    $attribute_value[] = $file_path;
                }
            }
        }
        $this->attributes[$attribute_name] = json_encode($attribute_value);
    }

    public function setFilesAttribute($value)
    {
        $attribute_name = 'files';
        $disk = 'public';
        $destination_path = 'files';

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
