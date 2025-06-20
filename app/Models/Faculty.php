<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(Siakad::class);
    }
}
