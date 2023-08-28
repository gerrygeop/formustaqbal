<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'embed_links' => 'array',
    ];

    public function submodule()
    {
        return $this->belongsTo(Submodule::class);
    }
}
