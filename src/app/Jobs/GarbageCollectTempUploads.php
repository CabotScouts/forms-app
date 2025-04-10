<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class GarbageCollectTempUploads implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $limit = config('filepond.gc_max_file_minutes_age', 60 * 6);

        if (!is_int($limit) || $limit < 0) {
            return;
        }

        $limit = Carbon::now()->subMinutes($limit)->timestamp;

        $disk = Storage::disk(config('filepond.temporary_files_disk', 'local'));
        $path = config('filepond.temporary_files_path');
        $chunkPath = config('filepond.chunks_path');
        
        $directories = collect($disk->directories($path))
            ->merge($disk->directories($chunkPath))
            ->filter(fn($dir) => $dir != $chunkPath)
            ->filter(fn($dir) => $disk->lastModified($dir) < $limit);

        foreach ($directories as $directory) {
            $disk->deleteDirectory($directory);
        }
    }
}
