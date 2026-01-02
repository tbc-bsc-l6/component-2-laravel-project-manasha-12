<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable implements MustVerifyEmail
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
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function activeEnrollments(): HasMany
    {
        return $this->enrollments()->where('status', 'active');
    }

    public function completedEnrollments(): HasMany
    {
        return $this->enrollments()->where('status', 'completed');
    }

    // Helper methods
    public function getRole(): string
    {
        return 'student';
    }

    public function isStudent(): bool
    {
        return true;
    }

    public function canEnrollInMoreModules(): bool
    {
        return $this->activeEnrollments()->count() < 4;
    }

    public function isEnrolledIn(Module $module): bool
    {
        return $this->activeEnrollments()
            ->where('module_id', $module->id)
            ->exists();
    }

    public function hasCompletedModule(Module $module): bool
    {
        return $this->completedEnrollments()
            ->where('module_id', $module->id)
            ->exists();
    }

    public function getActiveEnrollmentCount(): int
    {
        return $this->activeEnrollments()->count();
    }

    public function getRemainingSlots(): int
    {
        return 4 - $this->getActiveEnrollmentCount();
    }
}