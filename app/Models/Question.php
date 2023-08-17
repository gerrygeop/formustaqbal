<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function questionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function choices(): HasOne
    {
        return $this->hasOne(QuestionChoice::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
