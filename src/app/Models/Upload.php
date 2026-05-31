<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Exceptions\FileUploadError;

class Upload extends Model
{
    protected $fillable = ['name', 'path'];
    
    public function uploadable(): MorphTo
    {
        return $this->morphTo();
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

    static public function processUploads($submitted)
    {
        try {
            $submitted = json_decode($submitted);
            $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
            $uploads = [];

            foreach($submitted as $sid) {
                $temppath = $filepond->getPathFromServerId($sid);
                if(Storage::exists($temppath)) {
                    $file = basename($temppath);
                    $uuid = Str::uuid()->toString();
                    $path = sprintf("uploads/%s_%s", $uuid, $file);
                    $fullpath = sprintf("public/%s", $path);
                    Storage::move($temppath, $fullpath);
                    $uploads[] = Upload::create(['name' => $file, 'path' => $path]);
                } else {
                    throw new FileUploadError("Temporary file not found");
                }
            }
            
            return $uploads;
        } catch (Exception) {
            throw new FileUploadError("Unknown file upload error");
        }
    }
}
