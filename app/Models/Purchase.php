<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Notifications\Notifiable;

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
}
