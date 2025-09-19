<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Exceptions\FileUploadError;
use App\Models\Upload;

trait AcceptsUploads
{

    public function uploads(): MorphMany
    {
        return $this->morphMany(Upload::class, 'uploadable');
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

    public function removeUploads()
    {
        foreach($this->uploads()->get() as $upload)
        {
            $upload->deleteFile();
            $upload->delete();
        }
    }
}
