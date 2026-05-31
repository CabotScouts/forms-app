<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

use App\Models\Upload;

trait AcceptsUploads
{

    public function uploads(): MorphMany
    {
        return $this->morphMany(Upload::class, 'uploadable');
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
