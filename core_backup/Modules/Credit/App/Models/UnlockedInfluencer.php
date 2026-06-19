<?php

namespace Modules\Credit\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnlockedInfluencer extends Model
{
    protected $table = 'unlocked_influencers';

    protected $fillable = [
        'client_id',
        'influencer_id',
        'credits_used',
    ];

    protected $casts = [
        'credits_used' => 'integer',
    ];

    /**
     * The client who unlocked the influencer.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'client_id');
    }

    /**
     * The influencer whose profile was unlocked.
     */
    public function influencer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'influencer_id');
    }
}
