<?php

namespace Modules\Credit\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Credit\Database\factories\CreditFactory;

class Credit extends Model
{
    protected $table = 'credits';

    protected $fillable = [
        'user_id',
        'payment_gateway',
        'payment_status',
        'transaction_id',
        'manual_payment_image',
        'credits',
        'status',
    ];

    protected $casts = [
        'credits' => 'integer',
        'status' => 'boolean', // or 'integer' if you prefer 0/1
    ];

    // 🔗 Belongs to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
