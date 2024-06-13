<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

use App\Models\GroupContact;

class Group extends Model
{
    public $timestamps = false;
    protected $fillable = ['number', 'name'];
    protected $with = ['contacts'];

    public function contacts(): HasMany
    {
      return $this->hasMany(GroupContact::class);
    }

    public function emails(): Collection
    {
      return $this->contacts()->get()->map(function (GroupContact $contact) { return $contact->email; });
    }
}
