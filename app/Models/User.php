<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'balance',
        'is_registered',
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
    ];

    protected $sortable = [
        'name', 'role_id', 'created_at', 'balance'
    ];

    protected function password(): Attribute {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Hash::make($value),
        );
    }

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }

    public function service(): HasMany {
        return $this->hasMany(service::class);
    }
    
    public function services(): BelongsToMany {
        return $this->belongsToMany(Service::class, 'purchases')
                    ->using(Purchase::class)
                    ->withPivot('id', 'by_cash' , 'credit', 'debit', 'user_balance', 'admin_id', 'created_at');
    }

    public function purchases(): HasMany {
        return $this->hasMany(Purchase::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    
    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    public function scopeAllAdmin(Builder $query): Builder
    {
        return $query->where('role_id', 1)->orWhere('role_id', 3);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
            $filters['by'] ?? false,
            fn ($query, $value) =>
            !in_array($value, $this->sortable)
                ? $query :
                $query->orderBy($value, $filters['order'] ?? 'asc')
        )->when(
            $filters['q'] ?? false,
            fn ($query, $value) => $query->where('users.name', 'LIKE', "%{$value}%")
        )->when($filters['is_registered'] ?? false, function ($query, $value) {
                if($value == 'true') {
                    $query->where('is_registered', true);
                } 
                if($value == 'false') {
                    $query->where('is_registered', false);
                }
            }
        )->when(
            $filters['date'] ?? false,
            fn ($query, $value) => $query->whereDate('users.created_at', date('Y-m-d', strtotime($value)))
        );
    }

    public function scopeUserWithAdminAndRoleName(Builder $query): Builder
    {
        return $query->join('roles', 'users.role_id', '=', 'roles.id')
                    ->join('users as users_1', 'users.user_id', '=', 'users_1.id')
                    ->select('users.*', 'roles.name as role_name', 'users_1.name as user_name');
    }
}

