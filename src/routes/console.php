<?php

use Illuminate\Support\Facades\Schedule;

use App\Jobs\GarbageCollectTempUploads;

Schedule::command('model:prune')->daily();
Schedule::job(new GarbageCollectTempUploads)->everyFiveMinutes();