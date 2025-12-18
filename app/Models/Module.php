<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'max_students',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    // Relationships
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'module_teachers')
            ->withTimestamps()
            ->withPivot('assigned_at');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function activeEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class)->where('status', 'active');
    }

    public function completedEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class)->where('status', 'completed');
    }

    // Helper methods
    public function hasAvailableSpots(): bool
    {
        return $this->activeEnrollments()->count() < $this->max_students;
    }

    public function canEnroll(): bool
    {
        return $this->is_available && $this->hasAvailableSpots();
    }

    public function getAvailableSpotsAttribute(): int
    {
        return max(0, $this->max_students - $this->activeEnrollments()->count());
    }

    public function getCurrentEnrollmentCount(): int
    {
        return $this->activeEnrollments()->count();
    }

    public function isAssignedToTeacher(Teacher $teacher): bool
    {
        return $this->teachers()->where('teachers.id', $teacher->id)->exists();
    }
}