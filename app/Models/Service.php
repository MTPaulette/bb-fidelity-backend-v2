<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Service extends Model

{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'credit',
        'debit',
        'validity',
        'service_type',
        'agency',
        'description',
        'is_registered',
        'user_type',
    ];
    
    protected $sortable = [
        'name', 'created_at'
    ];
    // public function getBbPointAttribute() {
    //     return $this->price/100;
    // }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'purchases')
                    ->using(Purchase::class)
                    ->withPivot('id', 'by_cash' , 'credit', 'debit', 'user_balance', 'admin_id', 'created_at');
    }


    public function scopeAlphabetical(Builder $query): Builder
    {
        return $query->orderBy('name', 'asc');
    }
    
    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
            $filters['agency'] ?? false,
            fn ($query, $value) => $query->where('agency', '=', $value)
        )->when(
            $filters['validity'] ?? false,
            fn ($query, $value) => $query->where('validity', '=', $value)
        )->when(
            $filters['service_type'] ?? false,
            fn ($query, $value) => $query->where('service_type', '=', $value)
        )->when(
            $filters['by'] ?? false,
            fn ($query, $value) =>
            !in_array($value, $this->sortable)
                ? $query :
                $query->orderBy($value, $filters['order'] ?? 'asc')
        )->when(
            $filters['user_type'] ?? false,
            fn ($query, $value) => $query->where('user_type', '=', $value)
        )
        ->when(
            $filters['q'] ?? false,
            fn ($query, $value) => $query->where('name', 'LIKE', "%{$value}%")
        );
    }
}
