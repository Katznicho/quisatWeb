<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $fillable = [
        'name',
        'description',
        'program_category_id',
        'status',
        'thumbnail',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(ProgramEvent::class);
    }

    public function category()
    {
        return $this->belongsTo(ProgramCategory::class, 'program_category_id');
    }
}
