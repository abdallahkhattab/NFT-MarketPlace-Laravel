<?php
namespace App\Traits;

use Illuminate\Support\Str;

Trait imageUploadTrait {

    public function uploadImage($file, $folder = 'uploads')
    {
        $originalName = $file->getClientOriginalName();
        $filename = time() . '-' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();
        $finalName = $filename . '.' . $extension;

        return $file->storeAs($folder, $finalName, 'public');
    }
}