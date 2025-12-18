<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = ['name', 'description'];

    // Helper constants
    public const ADMIN = 'admin';
    public const TEACHER = 'teacher';
    public const STUDENT = 'student';
    public const OLD_STUDENT = 'old_student';

    // Static helper methods
    public static function adminRole()
    {
        return self::where('name', self::ADMIN)->first();
    }

    public static function teacherRole()
    {
        return self::where('name', self::TEACHER)->first();
    }

    public static function studentRole()
    {
        return self::where('name', self::STUDENT)->first();
    }

    public static function oldStudentRole()
    {
        return self::where('name', self::OLD_STUDENT)->first();
    }
}