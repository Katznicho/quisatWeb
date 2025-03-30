<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'website',
        'description',
        'business_type',
        'status',
    ];

    public function businessAdmin()
    {
        return $this->hasOne(BusinessAdmin::class);
    }
}
