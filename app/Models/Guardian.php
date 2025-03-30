<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guardian extends Model
{
    protected $fillable = [
        'school_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'alternate_phone',
        'occupation',
        'address',
        'city',
        'state',
        'postal_code',
        'relationship',
        'status',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}