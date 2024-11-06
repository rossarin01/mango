<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FileImage
{
    function uploadFile($storage_path, $file)
    {
        $path = Storage::disk('public')->put($storage_path, $file);
        return $path;
    }

    function deleteFile($file)
    {
        if (Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }
    }

}
