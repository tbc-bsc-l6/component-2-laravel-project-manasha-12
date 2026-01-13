<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'module_id',
        'enrolled_at',
        'completed_at',
        'status',
        'pass_status',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relationships
    public function student()
    {
        // This can return either Student or OldStudent
        return $this->belongsTo(Student::class, 'student_id')
            ->orWhere(function($query) {
                return $this->belongsTo(OldStudent::class, 'student_id');
            });
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    // Helper methods
    public function complete(string $passStatus): void
    {
        $this->update([
            'completed_at' => now(),
            'status' => 'completed',
            'pass_status' => $passStatus,
        ]);
    }

    public function markAsPass(): void
    {
        $this->complete('pass');
    }

    public function markAsFail(): void
    {
        $this->complete('fail');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function hasPassed(): bool
    {
        return $this->pass_status === 'pass';
    }
}