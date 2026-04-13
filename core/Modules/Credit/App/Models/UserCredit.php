<?php

namespace Modules\Credit\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Credit\Database\factories\UserCreditFactory;

class UserCredit extends Model
{
    protected $table = 'user_credits';

    protected $fillable = [
        'user_id',
        'credit_balance',
    ];

    protected $casts = [
        'credit_balance' => 'integer',
    ];

    // 🔗 Belongs to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // ✅ Helper: Increment balance safely
    public function addCredits(int $amount): self
    {
        $this->credit_balance += $amount;
        $this->save();
        return $this;
    }

    // ✅ Helper: Deduct credits (returns bool for success)
    public function deductCredits(int $amount): bool
    {
        if ($this->credit_balance < $amount) {
            return false;
        }

        $this->credit_balance -= $amount;
        $this->save();
        return true;
    }
}
