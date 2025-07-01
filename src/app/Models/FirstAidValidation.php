<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model, Prunable, SoftDeletes};

use App\Traits\AcceptsUploads;
use App\Mail\FirstAidValidationSubmitted;

class FirstAidValidation extends Model
{
    use AcceptsUploads, Prunable, SoftDeletes;

    protected $with = ['uploads'];
    protected $fillable = ['name', 'email', 'membership', 'date', 'additional'];

    public function send()
    {
        $m = Mail::to(config('scout.first_aid_validator_email'));
        $m->queue(new FirstAidValidationSubmitted($this));
    }

    public function prunable(): Builder
    {
        return static::where('updated_at', '<=', now()->subMonths(3));
    }

    public function pruning(): void
    {
        $this->removeUploads();
    }  
}
