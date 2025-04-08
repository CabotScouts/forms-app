<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    public static function from($path): Upload
    {
        $upload = new Upload;
        $upload->path = $path;
        $upload->name = basename($path);
        return $upload;
    }

    public function url()
    {
        return asset("storage/" . $this->path);
    }
}
