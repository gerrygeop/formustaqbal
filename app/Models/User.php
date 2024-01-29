<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getRouteKeyName(): string
    {
        return 'username';
    }

    public function canAccessFilament(): bool
    {
        return $this->hasRole('superadmin');
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roles): bool
    {
        return $this->roles->pluck('name')->contains($roles);
    }

    public function hasRoleAndRoom($role, $module): bool
    {
        if ($this->roles->pluck('name')->contains($role) && $this->rooms->pluck('module_id')->contains($module)) {
            return true;
        } else {
            return false;
        }
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_user')->withTimestamps();
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'course_user')->withPivot(['course_id', 'completed_submodules', 'last_visit'])->withTimestamps();
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function assessments(): BelongsToMany
    {
        return $this->belongsToMany(Assessment::class, 'assessment_user', 'user_id')->withPivot(['score', 'is_completed'])->withTimestamps();
    }

    public function placementTest(): HasOne
    {
        return $this->hasOne(AssessmentUser::class);
    }

    public function siakad(): HasOne
    {
        return $this->hasOne(Siakad::class);
    }

    public function responsi(): HasMany
    {
        return $this->hasMany(UserResponses::class);
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room_user')->withPivot('type')->withTimestamps();
    }

    public function grade(): HasOne
    {
        return $this->hasOne(StudentGrade::class);
    }
}
