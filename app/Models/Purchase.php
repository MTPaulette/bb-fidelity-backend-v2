<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Builder;

class Purchase extends Pivot
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'by_cash',
        'credit',
        'debit',
        'user_balance',
        'admin_id'
    ];

    public function admin(): BelongsTo {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function scopeServiceWithAdminName(Builder $query): Builder
    {
        return $query->orderByDesc('services.created_at');
        return $query->join('users', 'purchases.user_id', '=', 'users.id')
                    ->join('users as users_1', 'purchases.admin_id', '=', 'users_1.id')
                    ->join('services', 'purchases.service_id', '=', 'services.id')
                    ->select('purchases.*', 'users.name as user_name', 'users_1.name as admin_name', 'services.name as service_name', 'services.price as price', 'services.validity as validity', 'services.agency as agency', 'services.service_type as service_type');
    }

}
