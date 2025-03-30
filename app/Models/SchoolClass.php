<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SchoolClass extends Model
{
    protected $fillable = [
        'school_id',
        'name',
        'grade_level',
        'section',
        'capacity',
        'academic_year',
        'status',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'class_subjects')
            ->withPivot('teacher_id')
            ->withTimestamps();
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'class_subjects');
    }
}
