<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Submodule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'submodules';

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function material(): HasOne
    {
        return $this->hasOne(Material::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function assessments(): MorphMany
    {
        return $this->morphMany(Assessment::class, 'assessmentable');
    }
}
