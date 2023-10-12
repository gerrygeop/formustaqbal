<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user')->withPivot(['completed_submodules', 'last_visit']);
    }

    public function submodules(): HasMany
    {
        return $this->hasMany(Submodule::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function isUserValid()
    {
        return $this->users()->where('user_id', auth()->id())->exists();
    }

    public function isSubmoduleExists($submoduleId)
    {
        return $this->submodules()->where('id', $submoduleId)->exists();
    }

    public function getAllChapters()
    {
        return $this->submodules->sortBy('list_sort')->flatMap(function ($submodule) {
            return $submodule->chapters->sortBy('list_sort');
        });
    }

    public function updateUserCompletedSubmodules($completedSubmodules)
    {
        $this->users()
            ->updateExistingPivot(auth()->id(), ['completed_submodules' => json_encode($completedSubmodules)]);
    }

    public function getFirstChapterFromFirstSubmodule()
    {
        $submodule = $this->submodules->sortBy('list_sort')->first();

        if (!$submodule) {
            return null;
        }

        return $submodule->chapters->sortBy('list_sort')->first();
    }
}
