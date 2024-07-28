<?php

namespace App\Models;

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
        'point',
        'validity',
        'description',
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
                    ->withPivot('id', 'by_cash' , 'bonus_point', 'user_balance', 'created_at', 'created_at');
                    
                    // ->withPivot('id', 'by_cash' , 'bonus_point', 'user_balance', 'admin_id');
    }
}
