<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class SchoolAdmin extends Authenticatable implements FilamentUser
{
    use HasFactory, HasApiTokens;
    protected $fillable = [
        'school_id',
        'name',
        'name',
        'email',
        'password',
        'phone',
        'role',
        'join_date',
        'address',
        'status',
    ];
    

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'join_date' => 'date',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'school' && $this->status === 'active';
    }
}
