<?php

namespace App\Models;

use App\Events\AnswerUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use PhpOption\Option;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $dispatchesEvents = [
    //     'updated' => AnswerUpdated::class,
    // ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function questions(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function choice(): BelongsTo
    {
        return $this->belongsTo(Choice::class);
    }
}
