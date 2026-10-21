<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    // Scope: project yang dibuat hari ini
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', today());
    }

    // Scope: project dengan judul mengandung kata tertentu
    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        return $query->where('title', 'like', "%{$keyword}%");
    }

    // Scope: project dengan status 'published'
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    // Scope: project dengan status 'draft'
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }
}