<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'galleries';

    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'images'
    ];

    public function uploadMultipleImagesToDisk($value, $attribute_name, $disk, $destination_path)
    {
        $request = \Request::instance();
        $attribute_value = (array) $this->{$attribute_name};
        $files_to_clear = $request->get('clear_'.$attribute_name);

        if ($files_to_clear) {
            $attribute_value[0] = str_replace('[', '', $attribute_value[0]);
            $attribute_value[0] = str_replace(']', '', $attribute_value[0]);
            $attribute_value[0] = str_replace('"', '', $attribute_value[0]);
            $attribute_value[0] = stripslashes($attribute_value[0]);
            $values = explode(',', $attribute_value[0]);

            foreach ($files_to_clear as $filename) {
                \Storage::disk($disk)->delete($filename);
                $item = GalleryItems::where('path', $filename)->where('gallery_id', $this->id)->delete();
            }

            $attribute_value = array_diff($values, $files_to_clear);
        }

        if ($request->hasFile($attribute_name)) {
            foreach ($request->file($attribute_name) as $file) {
                if ($file->isValid()) {
                    $new_file_name = $file->getClientOriginalName();
                    $file_path = $file->storeAs($destination_path, $new_file_name, $disk);
                    $attribute_value[] = $file_path;

                    GalleryItems::create([
                        'title' => $new_file_name,
                        'path' => $file_path,
                        'gallery_id' => $this->getNextId()
                    ]);
                }
            }
        }

        $this->attributes[$attribute_name] = json_encode($attribute_value);
    }

    public function setImagesAttribute($value)
    {
        $attribute_name = 'images';
        $disk = 'public';
        $destination_path = 'galleries';

        $this->uploadMultipleImagesToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function getNextId()
    {
        $statement = \DB::select("show table status like 'galleries'");
        return $statement[0]->Auto_increment;
    }
}
