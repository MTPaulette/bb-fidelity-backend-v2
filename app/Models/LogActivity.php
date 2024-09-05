<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LogActivity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'url', 'method', 'ip', 'agent', 'user_id'
    ];
    
    protected $sortable = [
        'description', 'user_id', 'created_at', 'method'
    ];
    
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
            fn ($query, $value) => $query->where('description', 'LIKE', "%{$value}%")
        )->when(
            $filters['date'] ?? false,
            fn ($query, $value) => $query->whereDate('log_activities.created_at', date('Y-m-d', strtotime($value)))
        );
    }
}
