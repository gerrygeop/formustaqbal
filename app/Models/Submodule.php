<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
}
