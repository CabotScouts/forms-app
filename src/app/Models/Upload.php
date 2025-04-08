<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Upload extends Model
{
    public static function from($path): Upload
    {
        $upload = new Upload;
        $upload->path = $path;
        $upload->name = basename($path);
        return $upload;
    }

    public function url(): string
    {
        return asset("storage/" . $this->path);
    }

    public function basePath(): string
    {
        return sprintf("public/%s", $this->path);
    }

    public function deleteFile()
    {
        if(Storage::exists($this->basePath())) {
            Storage::delete($this->basePath());
        }
    }
}
