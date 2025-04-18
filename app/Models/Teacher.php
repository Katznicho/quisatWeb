<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
 

    protected $fillable = [
        'staff_id',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'profile_image',
        'national_id',
        'email',
        'phone',
        'emergency_contact',
        'address',
        'qualification',
        'join_date',
        'school_id',
        'status',
    ];
    protected $guarded = [];

    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
