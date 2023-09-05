<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Chapter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'chapters';

    public function submodule(): BelongsTo
    {
        return $this->belongsTo(Submodule::class);
    }

    public function material(): HasOne
    {
        return $this->hasOne(Material::class);
    }

    public function assessment(): MorphOne
    {
        return $this->morphOne(Assessment::class, 'assessmentable');
    }
}
