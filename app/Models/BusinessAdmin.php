<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAdmin extends Model
{
    use HasFactory;

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
