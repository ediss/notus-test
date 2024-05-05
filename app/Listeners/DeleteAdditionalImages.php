<?php

namespace App\Listeners;

use App\Events\ProductDeleted;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class DeleteAdditionalImages
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductDeleted $event): void
    {

        $product = $event->product;
    
        $this->deleteFile($product->main_image);
        
        foreach ($product->images as $image) {

            // Storage::delete($image->path);

            $this->deleteFile($image->path);

            $image->delete();
        }
    }


    private function deleteFile($file) {

        $path = parse_url($file);
            
        File::delete(public_path($path['path']));
    }
}
