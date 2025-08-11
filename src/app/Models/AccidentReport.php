<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model, Prunable, SoftDeletes};
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Mail;

use App\Mail\AccidentReportSubmitted;

class AccidentReport extends Model
{
    use Prunable;

    protected $fillable = ['reporter_name', 'reporter_email', 'reporting_unit', 'their_name', 'their_dob', 'their_unit', 'when', 'where', 'details', 'treatment', 'further_reporting', 'remove_at'];

    protected function casts(): array
    {
        return [
            'when' => 'date',
            'their_dob' => 'date',
            'remove_at' => 'date',
        ];
    }

    public function send()
    {
        $m = Mail::to(config('scout.accident_report_email'))->cc($this->reporter_email);
        $m->queue(new AccidentReportSubmitted($this));
    }

    public function prunable(): Builder
    {
        return static::where('remove_at', '<=', now());
    }

}
