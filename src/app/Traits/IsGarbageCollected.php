<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Prunable;

trait IsGarbageCollected
{
    use Prunable;

    public function prunable(): Builder
    {
        return static::where('date', '<=', now()->subMonths(3));
    }

    public function pruning(): void
    {
        foreach($this->uploads()->get() as $upload)
        {
            $upload->deleteFile();
            $upload->delete();
        }
    }
}
