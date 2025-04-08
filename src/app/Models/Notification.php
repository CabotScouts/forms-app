<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    use SoftDeletes;

    protected $with = ['uploads'];
    protected $fillable = [
        'lic_name', 'lic_email', 'lic_phone', 'submitter_name', 'submitter_email',
        'group', 'section', 'number_squirrels', 'number_beavers', 'number_cubs',
        'number_scouts', 'number_explorers', 'number_adults', 'date', 'location',
        'description', 'activity_leader', 'activity_leader_email', 'intouch',
        'team_leader_email'
    ];

    public function uploads(): HasMany
    {
        return $this->hasMany(Upload::class);
    }
}
