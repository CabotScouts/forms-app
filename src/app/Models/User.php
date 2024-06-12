<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model
{
    protected $with = ['permission'];
    
    protected $fillable = [
        'name',
        'email',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'last_login' => 'datetime',
        ];
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function can(string $permission): bool
    {
        return $this->permissions()->where('key', $permission)->first() ?? Permission::where('key', $permission)->first()->default ?? false;
    }
}
