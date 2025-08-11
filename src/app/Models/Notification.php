<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model, Prunable, SoftDeletes};
use Illuminate\Support\Facades\Mail;

use App\Traits\AcceptsUploads;
use App\Mail\NotificationSubmitted;

class Notification extends Model
{
    use AcceptsUploads, Prunable, SoftDeletes;

    protected $with = ['uploads'];

    protected $fillable = [
        'lic_name', 'lic_email', 'lic_phone', 'submitter_name', 'submitter_email',
        'group', 'section', 'number_squirrels', 'number_beavers', 'number_cubs',
        'number_scouts', 'number_explorers', 'number_adults', 'date', 'location',
        'description', 'activity_leader', 'intouch', 'team_leader_email'
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function send(): void
    {
        $submitter = $this->submitter_email ?? $this->lic_email;
        $to = [config('scout.activity_notification_email'), $submitter];
        $cc = [$this->team_leader_email];

        if($submitter != $this->lic_email) {
            $cc[] = $this->lic_email;
        }

        $m = Mail::to($to)->cc($cc);
        $m->queue(new NotificationSubmitted($this));
    }

    public function prunable(): Builder
    {
        return static::where('date', '<=', now()->subMonths(3));
    }

    public function pruning(): void
    {
        $this->removeUploads();
    }    
}
