<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siakad extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    protected $guarded = [];
    protected $table = 'siakad';
    public $incrementing = false;
    public $timestamps = false;

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function faculties(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function departments(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function locals(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
