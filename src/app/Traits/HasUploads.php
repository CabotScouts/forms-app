<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Upload;

trait HasUploads
{

    public function uploads(): HasMany
    {
        return $this->hasMany(Upload::class);
    }
}
