<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Gallery as GalleryTable;
use App\Models\GalleryItems;

class Gallery extends Component
{
    public $galleryID;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($galleryID)
    {
        $this->galleryID = $galleryID;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $gallery = GalleryTable::find($this->galleryID);
        $galleryItems = GalleryItems::where('gallery_id', '=', $this->galleryID)->get();

        return view('components.gallery',
            [
                'gallery' => $gallery,
                'galleryItems' => $galleryItems,
            ]);
    }
}
