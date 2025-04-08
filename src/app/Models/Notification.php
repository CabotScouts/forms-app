<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model, Prunable, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    use Prunable, SoftDeletes;

    protected $with = ['uploads'];
    protected $fillable = [
        'lic_name', 'lic_email', 'lic_phone', 'submitter_name', 'submitter_email',
        'group', 'section', 'number_squirrels', 'number_beavers', 'number_cubs',
        'number_scouts', 'number_explorers', 'number_adults', 'date', 'location',
        'description', 'activity_leader', 'intouch', 'team_leader_email'
    ];

    public function uploads(): HasMany
    {
        return $this->hasMany(Upload::class);
    }

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
