<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function assessment(): MorphOne
    {
        return $this->morphOne(Assessment::class, 'assessmentable');
    }
}
