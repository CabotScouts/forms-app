<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

use App\Models\Upload;

trait AcceptsUploads
{

    public function uploads(): HasMany
    {
        return $this->hasMany(Upload::class);
    }

    public function processUploads($submitted)
    {
        $submitted = json_decode($submitted);
        $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
        $uploads = [];

        foreach($submitted as $sid) {
            $temppath = $filepond->getPathFromServerId($sid);
            if(Storage::exists($temppath)) {
                $file = basename($temppath);
                // NEED TO MAKE UNIQUE NAMES HERE
                $path = sprintf("uploads/%s", $file);
                $fullpath = sprintf("public/%s", $path);
                Storage::move($temppath, $fullpath);

                $u = new Upload;
                $u->name = $file;
                $u->path = $path;
                $uploads[] = $u;
            }
        }
        
        $this->uploads()->saveMany($uploads);
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
