<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Submodule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'submodules';

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public function assessment(): MorphOne
    {
        return $this->morphOne(Assessment::class, 'assessmentable');
    }
}
