<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Choice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function answer(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
