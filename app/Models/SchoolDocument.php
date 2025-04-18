<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class SchoolDocument extends Model
{
    protected $fillable = [
        'school_id',
        'title',
        'description',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'category',
        'status',
        'uploaded_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($document) {
            if ($document->file_path) {
                $file = Storage::disk('public')->get($document->file_path);
                $document->file_name = basename($document->file_path);
                $document->file_size = Storage::disk('public')->size($document->file_path);
                $document->file_type = Storage::disk('public')->mimeType($document->file_path);
            }
        });
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(SchoolAdmin::class, 'uploaded_by');
    }
}