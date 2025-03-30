<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'school_id',
        'class_id',
        'parent_id',
        'admission_number',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'email',
        'phone',
        'address',
        'status',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Parent::class);
    }
}
