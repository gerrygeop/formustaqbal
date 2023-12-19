<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentGrade extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'student_grades';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
