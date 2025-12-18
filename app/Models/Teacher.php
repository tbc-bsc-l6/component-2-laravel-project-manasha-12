<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'module_teachers')
            ->withTimestamps()
            ->withPivot('assigned_at');
    }

    public function assignedModules(): BelongsToMany
    {
        return $this->modules();
    }

    // Helper methods
    public function getRole(): string
    {
        return 'teacher';
    }

    public function isTeacher(): bool
    {
        return true;
    }

    public function teachesModule(Module $module): bool
    {
        return $this->modules()->where('modules.id', $module->id)->exists();
    }
}