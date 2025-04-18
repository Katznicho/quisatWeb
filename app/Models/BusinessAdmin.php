<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class BusinessAdmin extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'business_id',
        'name',
        'email',
        'password',
        'phone',
        'status',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
