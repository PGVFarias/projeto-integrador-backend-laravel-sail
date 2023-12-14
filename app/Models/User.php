<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\UserTypes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'is_active'
    ];

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
        'is_active' => 'boolean',
        'type' => UserTypes::class
    ];

    protected $appends = [
        'is_admin',
        'active_state'
    ];

    public function scopeUsers(Builder $query): Builder
    {
        return $query->where('type', UserTypes::Usuario);
    }

    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $attributes['type'] === UserTypes::Administrador->value
        );
    }

    protected function activeState(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $attributes['is_active'] ? 'Sim' : 'Não'
        );
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

}
