<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model, SoftDeletes};
use Illuminate\Support\Facades\Mail;

use App\Traits\{AcceptsUploads, IsGarbageCollected};
use App\Mail\NotificationSubmitted;

class Notification extends Model
{
    use AcceptsUploads, IsGarbageCollected, SoftDeletes;

    protected $with = ['uploads'];

    protected $fillable = [
        'lic_name', 'lic_email', 'lic_phone', 'submitter_name', 'submitter_email',
        'group', 'section', 'number_squirrels', 'number_beavers', 'number_cubs',
        'number_scouts', 'number_explorers', 'number_adults', 'date', 'location',
        'description', 'activity_leader', 'intouch', 'team_leader_email'
    ];

    public function send(): void
    {
        $submitter = $this->submitter_email ?? $this->lic_email;
        $to = [config('scout.programme_team_email'), $submitter];
        $cc = [config('scout.dlv_email'), $this->team_leader_email];

        if($submitter != $this->lic_email) {
            $cc[] = $this->lic_email;
        }

        $m = Mail::to($to)->cc($cc);
        $m->queue(new NotificationSubmitted($this));
    }

    
}
